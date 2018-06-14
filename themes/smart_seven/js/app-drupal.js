(function ($, Drupal) {
  /**
   * Global config javascript.
   *
   * Start =============
   */
  $.root_ = $('body');

  /**
   * Global config javascript.
   *
   * End =============
   */
  var initApp = (function (app) {
    app.SmartActions = function () {
      var smartActions = {
        // MINIFY MENU
        minifyMenu: function($this) {
          if (!$.root_.hasClass("menu-on-top")) {
            $.root_.toggleClass("minified");
            $.root_.removeClass("hidden-menu");
            $('html').removeClass("hidden-menu-mobile-lock");
            $this.effect("highlight", {}, 500);
          }
        }
      };
    };

    return app;
  })({});

  $.root_.on('click', '[data-action="minifyMenu"]', function (e) {
    alert('fdafd');
    var $this = $(this);
    smartActions.minifyMenu($this);
    e.preventDefault();

    // clear memory reference
    $this = null;
  });





  // Initalize autoload
  initApp.SmartActions();
})(window.jQuery, window.Drupal);
