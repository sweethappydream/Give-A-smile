const $ = window.jQuery;

class Tab {
    /**
     * Create tabs.
     *
     * Tab buttons container: .function-tab
     * data-target: content container
     * data-id: connect for tab/content
     * data-active-class: active state for tab
     * data-show-class: active state for content
     */
    constructor(e = null) {
        this.tabsContainers = e ? e.find('.function-tab') : $('.function-tab');
        if (!this.tabsContainers.length) return;

        this.tabsContainers.each(this.tabCreator);
    }

    tabCreator() {
        const tabsContainer = $(this);
        const tabs = tabsContainer.children();
        const contents = $(tabsContainer.data('target')).children();
        const activeClass = tabsContainer.data('activeClass') ? tabsContainer.data('activeClass') : 'active';
        const showClass = tabsContainer.data('showClass') ? tabsContainer.data('showClass') : 'show';

        if (!tabs.length || !contents.length) return;

        tabs.first().addClass(activeClass);
        contents.filter('[data-id=' + tabs.first().data('id') + ']').addClass(showClass);

        tabs.on('click', function (e) {
            e.preventDefault();

            const activeTab = $(this);
            const activeContent = contents.filter('[data-id=' + activeTab.data('id') + ']');

            if (!activeContent.length) return;

            tabs.removeClass(activeClass);
            contents.removeClass(showClass);
            activeTab.addClass(activeClass);
            activeContent.addClass(showClass);
        });
    }
}

export default Tab;