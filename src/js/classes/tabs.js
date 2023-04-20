export default class tabs {
  constructor(selector) {
    this.selector = document.querySelector(selector);
    if (this.selector) {
      this.init();
    }
  }

  closeTabs(tabs) {
    tabs.forEach(tab => {
      tab.classList.remove('is-active');
    });
  }

  init() {
    let tabNav = this.selector.querySelectorAll('[data-tab]');
    let tabContent = this.selector.querySelectorAll('.c-tab__content');
    tabNav.forEach(tab => {
      tab.addEventListener('click', (event) => {
        let target = (event.target.classList.contains('.c-tab__item')) ? event.target : event.target.closest('.c-tab__item');
        let targetData = target.getAttribute('data-tab');

        this.closeTabs(tabNav);
        this.closeTabs(tabContent);

        target.classList.add('is-active');
        this.selector.querySelector(targetData).classList.add('is-active');
      });
    });
  }
}