const switcherBlock = document.querySelector('.c-row-switcher');

if (switcherBlock !== null) {
	let switcher = '';
	switcherBlock.addEventListener('click', activateItem);

	function activateItem(e) {
	  const item = e.target.closest('.c-row-switcher__item');
	  
	  if ( !item ) return;
	  
	  [...switcherBlock.children].forEach(child => child.classList.remove('is-active'));
	  
	  item.classList.add('is-active');

	  if (item.classList.contains('js-column-switcher')) {
			switcher = 'is-full-width';
		} else {
			switcher = '';
		}

		const gifts = document.querySelectorAll('.home-gifts .gifts__item');

		gifts.forEach(item => {
			if (switcher === 'is-full-width') {
				item.classList.add('is-full-width');
			} else {
				item.classList.remove('is-full-width');
			}
		});
	}
}