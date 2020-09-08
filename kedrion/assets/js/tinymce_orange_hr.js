(function () {
  tinymce.PluginManager.add('orange_hr_bars', function (editor, url) {
    editor.addButton("orange_hr", {
      title: "Orange Horizontal Line",
      cmd: "orange_hr",
      icon: "hr",
      classes: "orange-hr"
    });
    editor.addCommand("orange_hr", function () {
      var return_text = "<hr class='orange'>";
      editor.execCommand("mceReplaceContent", false, return_text);
      return;
    });


    editor.addButton("orange_hr_wide", {
      title: "Wide Orange Horizontal Line",
      cmd: "orange_hr_wide",
      icon: "minus",
      classes: "orange-hr"
    });
    editor.addCommand("orange_hr_wide", function () {
      var return_text = "<hr class='orange wide'>";
      editor.execCommand("mceReplaceContent", false, return_text);
      return;
    });
  });
})();