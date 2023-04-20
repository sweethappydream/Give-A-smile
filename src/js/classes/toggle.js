const $ = window.jQuery;

class Toggle {
    /**
     * Shows and hide target element by toggler.
     *
     * Toggler class: .function-toggle
     * data-target: target element
     * data-scroll-stop: is on - hide body overflow
     */
    constructor(e = null) {
        this.togglers = e ? e.find('.function-toggle') : $('.function-toggle');
        if (!this.togglers.length) return;

        this.togglers.on('click', this.toggleElement);
    }

    toggleElement(e) {
        e.preventDefault();

        const toggleTarget = $($(this).data('target'));
        const isScrollStop = $(this).data('scrollStop');

        if (!toggleTarget.length) return;

        if (!toggleTarget.hasClass('showed')) {
            if (isScrollStop) $('body').css('overflow', 'hidden');

            $(this).addClass('active');
            toggleTarget.addClass('show');
            setTimeout(() => {
                toggleTarget.addClass('showed');
            }, 300);
        } else {
            if (isScrollStop) $('body').css('overflow', '');

            $(this).removeClass('active');
            toggleTarget.removeClass(['show', 'showed'])
        }
    }
}

export default Toggle;