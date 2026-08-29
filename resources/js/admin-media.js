(function () {
  function bind(root) {
    var select = root.querySelector('.ks-media-select');
    var remove = root.querySelector('.ks-media-remove');
    var urlInput = root.querySelector('.ks-media-url');
    var idInput = root.querySelector('.ks-media-id');
    var preview = root.querySelector('.ks-media-preview');
    if (!select || !urlInput || typeof wp === 'undefined' || !wp.media) {
      return;
    }

    select.addEventListener('click', function (event) {
      event.preventDefault();
      var frame = wp.media({
        title: select.getAttribute('data-title') || 'Select image',
        library: { type: 'image' },
        button: { text: select.getAttribute('data-button') || 'Use image' },
        multiple: false,
      });
      frame.on('select', function () {
        var att = frame.state().get('selection').first().toJSON();
        var sized = (att.sizes && (att.sizes.medium || att.sizes.thumbnail || att.sizes.full)) || { url: att.url };
        urlInput.value = att.url || '';
        if (idInput) {
          idInput.value = String(att.id || '');
        }
        if (preview) {
          preview.src = sized.url || att.url;
          preview.hidden = false;
        }
        if (remove) {
          remove.hidden = false;
        }
      });
      frame.open();
    });

    if (remove) {
      remove.addEventListener('click', function (event) {
        event.preventDefault();
        urlInput.value = '';
        if (idInput) {
          idInput.value = '';
        }
        if (preview) {
          preview.removeAttribute('src');
          preview.hidden = true;
        }
        remove.hidden = true;
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.ks-media-field').forEach(bind);
  });
})();
