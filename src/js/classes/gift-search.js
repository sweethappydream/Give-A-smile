const $ = window.jQuery;

class GiftSearch {
    constructor(e = null) {
        let self = this;
        $('form[name="product-search"]').on('submit', function (e) {
            e.preventDefault();
            self.search(e.target);
        });
        self.expandKeywords();
        self.searchByKeywords();
    }

    searchByKeywords() {
        $('.filter-bar__list a').on('click', function (e) {
            $('.partners__gifts').addClass('loading');
            e.preventDefault();
            $(this).toggleClass('selected');

            if($(this).attr('aria-current')){
                $(this).removeAttr('aria-current');
            }else {
                $(this).attr('aria-current', true);
            }

            $(this).parent().toggleClass('chose');
            $('.search-bar input').val('');
            let current_language = $(this).closest('.search-bar form').data('lang');
            let selectedIds = [];

            $('.filter-bar__list a.selected').each(function () {
                selectedIds.push($(this).data('term-id'))
            });

            $.post('/wp-json/smile/v1/gifts', {terms: selectedIds, auth: themeVars.logIn, user_id: themeVars.userID,
            current_lang: current_language}, function (response) {
                $('.partners__gifts .gifts').html(response);
            })
            .always(function () {
                $('.partners__gifts').removeClass('loading');
            })
            .fail(function (response) {
                $('.partners__gifts .gifts').html(`<div class="not-found"><span>${response.responseJSON}</span></div>`)
            });
        })
    }

    expandKeywords() {
        $('.filter-bar__icon').on('click', function (e) {
            e.preventDefault();
            $('.filter-bar__list').toggleClass('expanded');
        });
    }

    search(form) {
        const input = $('.input_search').val();
        $(form).find('button').prop('disabled', true);
        $('.partners__gifts').addClass('loading');
        $('.filter-bar__list a').removeClass('selected');
        $('.filter-bar__list li').removeClass('chose');

        let current_language = $('.search-bar > form').data('lang');
        if (input.length > 0) {
            $.get(`/wp-json/smile/v1/gift/search=${input}`, {auth: themeVars.logIn, user_id: themeVars.userID,
                current_lang: current_language}, function (response) {
                $('.partners__gifts .gifts').html(response);
            })
            .always(function () {
                $(form).find('button').prop('disabled', false);
                $('.partners__gifts').removeClass('loading');
            })
            .fail(function (response) {
                $('.partners__gifts .gifts').html(`<div class="not-found"><div class="container"><p>${response.responseJSON}</p></div></div>`)
            });
        } else {
            $.get(`/wp-json/smile/v1/gifts/`, function (response) {
                $('.partners__gifts .gifts').html(response);
            })
            .always(function () {
                $(form).find('button').prop('disabled', false);
                $('.partners__gifts').removeClass('loading');
            })
        }
    }
}

export default GiftSearch;