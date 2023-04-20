document.addEventListener('DOMContentLoaded', function() {
  function allowMultipleLanguages(textarea) {
    var regex = /^[a-zA-Z\u00C0-\u024F\u1E00-\u1EFF\u0590-\u05FF\s,.]+$/;
    var valid = regex.test(textarea.value);
    if (!valid) {
      textarea.value = textarea.value.replace(/[^a-zA-Z\u00C0-\u024F\u1E00-\u1EFF\u0590-\u05FF\s,.]+/g, '');
      alert('Please enter only letters, spaces, commas, periods, and punctuation marks.');
    }
  }
});