// const updateSVG = () => {
// 	let messageField = document.querySelectorAll('.wrapper-textarea textarea');
// 	let svgField = document.querySelector('.text-from-input');

// 	if (messageField.length) {

// 		messageField.forEach((item) => {
// 			let $this = item

// 			if ( $this.classList.contains('current-m') ) {
// 				svgField.innerHTML = $this.value;
// 			};

// 			item.addEventListener('keydown', () => {
// 				svgField.innerHTML = $this.value;
// 			});
// 		})
// 	}

// }

// document.querySelector('.next-step').addEventListener('click', () => {
// 	setTimeout(() => {
// 		let arrowRight = document.querySelector('.arrow-right');
// 		let arrowLeft = document.querySelector('.arrow-left');

// 		updateSVG();

// 		arrowRight.addEventListener('click', () => {
// 			setTimeout(() => {
// 				updateSVG();
// 			})
// 		})

// 		arrowLeft.addEventListener('click', () => {
// 			setTimeout(() => {
// 				updateSVG();
// 			})
// 		})
// 	})

// });
