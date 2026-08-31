/* global wp, jQuery, ACRELINE_SCHEMES */
(function ($) {
  if (!wp || !wp.customize || !window.ACRELINE_SCHEMES) return;

  wp.customize.bind("ready", function () {
    wp.customize("ks_color_scheme", function (setting) {
      setting.bind(function (key) {
        var scheme = ACRELINE_SCHEMES[key];
        if (!scheme) return;
        if (wp.customize("ks_accent")) wp.customize("ks_accent").set(scheme.accent);
        if (wp.customize("ks_paper")) wp.customize("ks_paper").set(scheme.paper);
        if (wp.customize("ks_ink")) wp.customize("ks_ink").set(scheme.ink);
      });
    });
  });
})(jQuery);
