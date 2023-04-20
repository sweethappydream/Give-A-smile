/**
 * Create Custom Dropdown
 */
const $ = window.jQuery;

const createCustomDropdowns = () => {
  $("select.custom").each(function (i, select) {
    if (
      !$(this)
        .next()
        .hasClass("dropdown")
    ) {
      $(this).after(
        '<div class="dropdown ' +
        ($(this).attr("class") || "") +
        '" tabindex="0"><span class="current"></span><div class="list"><ul class="select-list"></ul></div></div>'
      );
      let dropdown = $(this).next(),
        options = $(select).find("option"),
        selected = $(this).find("option:selected");
      dropdown
        .find(".current")
        .html(selected.data("display-text") || selected.text());
      options.each(function (j, o) {
        let display = $(o).data("display-text") || "";
        dropdown
          .find("ul")
          .append(
            '<li class="option ' +
            ($(o).is(":selected") ? "selected" : "") +
            '" data-value="' +
            $(o).val() +
            '" data-display-text="' +
            display +
            '">' +
            $(o).text() +
            "</li>"
          );
      });
    }
  });

  // Event listeners

// Open/close
  $(document).on("click", ".dropdown", function () {
    $(".dropdown")
      .not($(this))
      .removeClass("open");
    $(this).toggleClass("open");
    if ($(this).hasClass("open")) {
      $(this)
        .find(".option")
        .attr("tabindex", 0);
      $(this)
        .find(".selected")
        .focus();
    } else {
      $(this)
        .find(".option")
        .removeAttr("tabindex");
      $(this).focus();
    }
  });

// Close when clicking outside
  $(document).on("click", function (event) {
    if ($(event.target).closest(".dropdown").length === 0) {
      $(".dropdown").removeClass("open");
      $(".dropdown .option").removeAttr("tabindex");
    }
    event.stopPropagation();
  });
// Option click
  $(document).on("click", ".dropdown .option", function () {
    $(this)
      .closest(".list")
      .find(".selected")
      .removeClass("selected");
    $(this).addClass("selected");
    let text = $(this).data("display-text") || $(this).text();
    $(this)
      .closest(".dropdown")
      .find(".current")
      .text(text);
    $(this)
      .closest(".dropdown")
      .prev("select")
      .val($(this).data("value"))
      .trigger("change");
  });

// Keyboard events
  $(document).on("keydown", ".dropdown", function (event) {
    let focused_option = $(
      $(this).find(".list .option:focus")[0] ||
      $(this).find(".list .option.selected")[0]
    );
    // Space or Enter
    if (event.keyCode === 32 || event.keyCode === 13) {
      if ($(this).hasClass("open")) {
        focused_option.trigger("click");
      } else {
        $(this).trigger("click");
      }
      return false;
      // Down
    } else if (event.keyCode === 40) {
      if (!$(this).hasClass("open")) {
        $(this).trigger("click");
      } else {
        focused_option.next().focus();
      }
      return false;
      // Up
    } else if (event.keyCode === 38) {
      if (!$(this).hasClass("open")) {
        $(this).trigger("click");
      } else {
        let focused_option = $(
          $(this).find(".list .option:focus")[0] ||
          $(this).find(".list .option.selected")[0]
        );
        focused_option.prev().focus();
      }
      return false;
      // Esc
    } else if (event.keyCode === 27) {
      if ($(this).hasClass("open")) {
        $(this).trigger("click");
      }
      return false;
    }
  });
};


export default createCustomDropdowns;
