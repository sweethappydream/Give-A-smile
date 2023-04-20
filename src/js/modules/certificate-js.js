const svgElement = document.getElementById('svg');

const inputTitle = document.getElementById('input-title');
const inputDescription = document.getElementById('input-description');
const inputShowPrice = document.getElementById('input-show-price');

const wrapperReceiversInputs = document.getElementById('wrapper-receivers-inputs');
const wrapperReceiversButtons = document.getElementById('wrapper-receivers-buttons');

const buttonAddReceiver = document.getElementById('btn-add-receiver');
const buttonExportSvg = document.getElementById('btn-submit');

const receivers = {};

const RECEIVER_DEFAULT_DATA = {
    title: '',
    description: '',
    name: '',
    showPrice: false,
};

let activeReceiverId;

// Updating data
// 
// ====================

const updateReceiverData = (id, part, value) => {
    receivers[id][part] = value;

    updateUi(id, part, value);
};

// Updating svg or html
// 
// ====================

const updateUi = (id, part, value) => {
    if (part === 'showPrice') {
        updateSvgPrice(value);

        return;
    }

    if (part === 'name') {
        updateReceiverButton(id, value);

        return;
    }

    updateSvgElement(part, value);
};

const updateSvgElement = (part, value) => {
    const element = svgElement.getElementById(part);

    element.textContent = value;
};

const updateSvgPrice = (checked) => {
    if (checked) {
        const PRICE = 5000;
        const CURRENCY = 'USD';
    
        const text = `Donated: ${PRICE} ${CURRENCY}`
    
        updateSvgElement('price', text);
    } else {
        updateSvgElement('price', '');
    }
};

const createReceiverControls = (id) => {
    const wrapper = document.createElement('div');

    wrapper.setAttribute('class', 'wrapper-receiver');
    wrapper.setAttribute('id', `wrapper-receiver-${id}`);

    const input = document.createElement('input');

    input.setAttribute('type', 'text');
    input.setAttribute('class', 'input');
    input.setAttribute('id', `input-receiver-${id}`);

    wrapper.appendChild(input);

    const button = document.createElement('button');

    button.setAttribute('type', 'button');
    button.setAttribute('class', 'btn-remove-receiver');
    button.setAttribute('id', `btn-remove-receiver-${id}`);
    button.innerText = 'X';

    wrapper.appendChild(button);

    wrapperReceiversInputs.appendChild(wrapper);

    input.addEventListener('input', ($event) => updateReceiverData.call(null, id, 'name', $event.target.value));

    button.addEventListener('click', () => removeReceiver.call(null, id));
};

const createReceiverButton = (id) => {
    const button = document.createElement('button');

    button.setAttribute('id', `btn-toggle-receiver-${id}`);
    button.setAttribute('class', 'btn-receiver btn-receiver__hidden');

    wrapperReceiversButtons.appendChild(button);

    button.addEventListener('click', () => toggleReceiver.call(null, id));
};

const updateReceiverButton = (id, value) => {
    const button = document.getElementById(`btn-toggle-receiver-${id}`);

    button.innerText = value;

    if (value) {
        button.classList.remove('btn-receiver__hidden');
    } else {
        button.classList.add('btn-receiver__hidden');
    }

    if (id === activeReceiverId) {
        updateSvgElement('name', value);
    }
};

const toggleReceiversButtons = (activatedId) => {
    const deactivatedButton = document.getElementById(`btn-toggle-receiver-${activeReceiverId}`);

    deactivatedButton?.classList.remove('btn-receiver__active');

    const activatedButton = document.getElementById(`btn-toggle-receiver-${activatedId}`);

    activatedButton.classList.add('btn-receiver__active');
};

const toggleDisabledReceiver = () => {
    if (Object.keys(receivers).length === 1) {
        const button = document.getElementById(`btn-remove-receiver-${activeReceiverId}`);
    
        button?.setAttribute('disabled', true);
    } else {
        const button = document.querySelector('.btn-remove-receiver[disabled="true"]');

        button.removeAttribute('disabled');
    }
};

// Updating inputs
// 
// ====================

const updateInput = (part, value) => {
    if (part === 'name') {
        return;
    }

    if (part === 'showPrice') {
        updateInputPrice(value);

        return;
    }

    updateInputElement(part, value);
};

const updateInputElement = (part, value) => {
    const element = document.getElementById(`input-${part}`);

    element.value = value;
};

const updateInputPrice = (value) => {
    const element = document.getElementById('input-show-price');

    element.checked = value;
};

// Receivers
// 
// ====================

const addReceiver = () => {
    const id = String(new Date().getTime());

    receivers[id] = { ...RECEIVER_DEFAULT_DATA };
    
    createReceiverControls(id);
    
    createReceiverButton(id);
    
    toggleDisabledReceiver();
};

const setDefaultReceiver = () => {
    activeReceiverId = Object.keys(receivers)[0];

    toggleReceiver(activeReceiverId);
};

const toggleReceiver = (id) => {
    toggleReceiversButtons(id);

    activeReceiverId = id;

    Object.entries(receivers[activeReceiverId]).forEach(([part, value]) => {
        updateUi(activeReceiverId, part, value);

        updateInput(part, value);
    });
};

const removeReceiver = (id) => {
    delete receivers[id];

    const wrapper = document.getElementById(`wrapper-receiver-${id}`);
    const buttonToggle = document.getElementById(`btn-toggle-receiver-${id}`);

    wrapper.remove();
    buttonToggle.remove();

    if (id === activeReceiverId) {
        setDefaultReceiver();
    }
    
    toggleDisabledReceiver();
};

// Export
// 
// ====================

const submit = async () => {
    const formData = new FormData();

    Object.keys(receivers).forEach((id) => {
        const svgData = svgElement.outerHTML;
    
        const svgBlob = new Blob([svgData], {type:"image/svg+xml;charset=utf-8"});
    
        formData.append(`cert-${id}.svg`, svgBlob);
    });

    let response;

    try {
        response = await fetch('https://httpbin.org/post', {
            method: 'POST',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: formData,
        });
    } catch (error) {
        console.log(error);
    }

   // console.log(response);
};

// Add the first receiver
// 
// ====================

addReceiver();

setDefaultReceiver();
    
toggleDisabledReceiver();

// Initial event listeners
// 
// ====================

inputTitle.addEventListener('input', ($event) =>  updateReceiverData.call(null, activeReceiverId, 'title', $event.target.value));

inputDescription.addEventListener('input', ($event) => updateReceiverData.call(null, activeReceiverId, 'description', $event.target.value));

inputShowPrice.addEventListener('change', ($event) => updateReceiverData.call(null, activeReceiverId, 'showPrice', $event.target.checked));

buttonAddReceiver.addEventListener('click', addReceiver);

buttonExportSvg.addEventListener('click', submit);
