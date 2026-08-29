/* =========================================================================
   Home-only behaviors
   - Search → listings
   - Home value + listing alerts (demo)
   - Showing appointment booking (demo)
   - Spotlight cards prefill property
   ========================================================================= */
(function(){
  "use strict";

  var form = document.getElementById("heroSearchForm");
  if(form){
    form.addEventListener("submit", function(e){
      e.preventDefault();
      var params = new URLSearchParams();
      var map = {hsType:"type", hsPrice:"price", hsAcreage:"acreage", hsTownship:"township"};
      Object.keys(map).forEach(function(id){
        var el = document.getElementById(id);
        if(!el) return;
        var v = el.value;
        if(v && v !== "all") params.set(map[id], v);
      });
      var qs = params.toString();
      var listingsUrl = (window.KEYSTONE && window.KEYSTONE.listingsUrl) || "/listings";
      window.location.href = listingsUrl + (qs ? "?" + qs : "");
    });
  }

  function formatMoney(n){
    return "$" + Math.round(n).toLocaleString("en-US");
  }

  /* Home value demo */
  var valueForm = document.getElementById("valueForm");
  var valueResult = document.getElementById("valueResult");
  if(valueForm && valueResult){
    valueForm.addEventListener("submit", function(e){
      e.preventDefault();
      var beds = Number(document.getElementById("vBeds").value) || 3;
      var acres = Number(document.getElementById("vAcres").value) || 5;
      var mid = 180000 + beds * 42000 + acres * 8500;
      var low = Math.round(mid * 0.92 / 1000) * 1000;
      var high = Math.round(mid * 1.08 / 1000) * 1000;
      valueResult.className = "val-result show";
      valueResult.innerHTML =
        "<strong>" + formatMoney(low) + " – " + formatMoney(high) + "</strong>" +
        "<span style=\"color:var(--ink-soft);font-size:.9rem\">Demo range for " +
        (document.getElementById("vAddress").value || "your address") +
        ". Not an appraisal.</span>";
    });
  }

  /* Listing alert demo */
  var alertForm = document.getElementById("alertForm");
  var alertConfirm = document.getElementById("alertConfirm");
  if(alertForm && alertConfirm){
    alertForm.addEventListener("submit", function(e){
      e.preventDefault();
      alertConfirm.classList.add("show");
      var btn = alertForm.querySelector("button[type=submit]");
      if(btn) btn.disabled = true;
    });
  }

  /* Showing booking */
  var showingForm = document.getElementById("showingForm");
  var slotGrid = document.getElementById("slotGrid");
  var showTime = document.getElementById("showTime");
  var showProperty = document.getElementById("showProperty");
  var showingConfirm = document.getElementById("showingConfirm");
  var showDate = document.getElementById("showDate");

  if(showDate){
    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    showDate.min = tomorrow.toISOString().slice(0, 10);
    if(!showDate.value) showDate.value = showDate.min;
  }

  if(slotGrid && showTime){
    slotGrid.addEventListener("click", function(e){
      var btn = e.target.closest(".slot");
      if(!btn || btn.disabled) return;
      slotGrid.querySelectorAll(".slot").forEach(function(s){
        s.classList.remove("is-selected");
        s.setAttribute("aria-pressed", "false");
      });
      btn.classList.add("is-selected");
      btn.setAttribute("aria-pressed", "true");
      showTime.value = btn.getAttribute("data-time") || "";
    });
  }

  if(showProperty){
    var params = new URLSearchParams(window.location.search);
    var listingId = params.get("listing");
    if(listingId){
      showProperty.value = listingId;
    }
  }

  if(showingForm && showingConfirm){
    showingForm.addEventListener("submit", function(e){
      e.preventDefault();
      if(!showTime.value){
        showingConfirm.className = "confirm-msg show";
        showingConfirm.style.background = "#fff7ed";
        showingConfirm.style.borderColor = "#fdba74";
        showingConfirm.style.color = "#9a3412";
        showingConfirm.textContent = "Pick a time slot to continue.";
        return;
      }
      var listingId = showProperty ? showProperty.value : "";
      var propLabel = showProperty && showProperty.selectedOptions[0] ? showProperty.selectedOptions[0].text : "a sample home";
      var when = (showDate && showDate.value ? showDate.value : "your date") + " · " + showTime.value;
      var name = (document.getElementById("showName") || {}).value || "Guest";
      var submitBtn = showingForm.querySelector("button[type=submit]");
      if(submitBtn) submitBtn.disabled = true;

      var endpoint = window.KEYSTONE && window.KEYSTONE.restUrl ? window.KEYSTONE.restUrl + "bookings" : "";
      var payload = {
        listing_id: listingId,
        date: showDate ? showDate.value : "",
        time: showTime.value,
        type: (document.getElementById("showType") || {}).value || "in-person",
        name: name,
        phone: (document.getElementById("showPhone") || {}).value || "",
        email: (document.getElementById("showEmail") || {}).value || "",
        notes: (document.getElementById("showNotes") || {}).value || ""
      };

      function showOk(message){
        showingConfirm.className = "confirm-msg show";
        showingConfirm.style.background = "";
        showingConfirm.style.borderColor = "";
        showingConfirm.style.color = "";
        showingConfirm.innerHTML = "<span><strong>Showing requested.</strong> " + (message || (name + " — " + propLabel + " on " + when)) + "</span>";
      }

      function showErr(message){
        if(submitBtn) submitBtn.disabled = false;
        showingConfirm.className = "confirm-msg show";
        showingConfirm.style.background = "#fff7ed";
        showingConfirm.style.borderColor = "#fdba74";
        showingConfirm.style.color = "#9a3412";
        showingConfirm.textContent = message || "Could not save this showing. Try again.";
      }

      if(!endpoint){
        showOk(name + " — " + propLabel + " on " + when + ". Saved locally only.");
        return;
      }

      fetch(endpoint, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-WP-Nonce": (window.KEYSTONE && window.KEYSTONE.nonce) || ""
        },
        body: JSON.stringify(payload)
      }).then(function(res){
        return res.json().then(function(data){ return { ok: res.ok, data: data }; });
      }).then(function(result){
        if(result.ok){
          showOk(result.data && result.data.message ? result.data.message : (name + " — " + propLabel + " on " + when));
        } else {
          var msg = result.data && result.data.message ? result.data.message : "Could not save this showing.";
          if(Array.isArray(msg)) msg = msg.join(" ");
          showErr(msg);
        }
      }).catch(function(){
        showErr("Network error — the showing was not saved.");
      });
    });
  }
})();
