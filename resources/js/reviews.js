/* =========================================================================
   Homepage review list — static demo only
   ========================================================================= */
(function () {
  "use strict";

  // Future: replace [data-reviews-source="demo"] cards from a server-proxied Google Places
  // reviews payload (author_name, rating, text, profile_photo_url, relative_time_description).
  // Do not call Google from the browser. Theme stays static until an endpoint exists.

  var root = document.getElementById("client-reviews");
  if (!root) {
    return;
  }

  var empty = root.querySelector(".reviews-empty");
  if (empty && !root.querySelector(".review-card")) {
    empty.removeAttribute("hidden");
  }
})();
