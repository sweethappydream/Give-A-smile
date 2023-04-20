export default class modal {
  constructor(modal, modalContainer) {
    this.modal = document.querySelectorAll(modal);
    this.modalContainer = document.querySelector(modalContainer);
    this.modalContainerClass = modalContainer.replace('.', '');
    this.init();
  }

  init() {
    let dataSelector = document.querySelectorAll('[data-modal]');

    if (dataSelector.length) {
      dataSelector.forEach(dataItem => {
        dataItem.addEventListener( 'click', (event) => {    

          let attrID = dataItem.getAttribute('data-modal');
          this.modalController(attrID);
        });
      });
    }

    this.modalContainer.addEventListener( 'click', (event) => {
      if (event.target.classList.contains(this.modalContainerClass)) {
        this.bodyScroll('close');
        this.closeModal(this.modal, this.modalContainer);
      }
    });
  }

  modalController(attrID) {
    let modalTarget = this.modalContainer.querySelector(attrID);

    if (attrID == 'close') {
      this.closeModal(this.modal, this.modalContainer);
      this.bodyScroll('close');
    } else {
      this.closeModal(this.modal);
      this.openModal(this.modalContainer, modalTarget);
      this.bodyScroll();        
    }     
  }

  bodyScroll(target) {
    const body = document.body;
    const html = document.documentElement;

    if (target === 'close') {
      body.classList.remove('is-overflow-hidden');
      html.classList.remove('is-overflow-hidden');
    } else {
      body.classList.add('is-overflow-hidden');
      html.classList.add('is-overflow-hidden');
    }
  }

  openModal(modalContainer, modalTarget) {
    if (!modalContainer.classList.contains('is-active')) {
      modalContainer.classList.add('is-active');
    }

    if (!modalTarget.classList.contains('is-active')) {
      modalTarget.classList.add('is-active');
    }
  }

  closeModal(modal, modalContainer = false) {
    modal.forEach(item => {
      if (item.classList.contains('is-active')) {
        item.classList.remove('is-active');
      }
    });

    if (modalContainer) {
      modalContainer.classList.remove('is-active');
    }
  }
}