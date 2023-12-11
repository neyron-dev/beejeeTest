$(document).ready(function () {
  $('.js-todo-item input[type="checkbox"]').each(function (index, element) {
    if (element.checked) {
      $(element).parents(".js-todo-item").addClass("todolist__item--done");
    }
  });

  $('.js-todo-item input[type="checkbox"]').on("change", function () {
    $(this).parents(".js-todo-item").toggleClass("todolist__item--done");
  });

  const searchString = new URLSearchParams(window.location.search);

  let paramBy = searchString.get("by");
  if (paramBy != null) {
    $(".js-sort-values option").each(function (index, element) {
      if ($(element).val() == paramBy) {
        $(element).attr("selected", "");
      }
    });
  }

  let paramOrder = searchString.get("order");
  if (paramOrder == null || paramOrder == "desc") {
    $(".js-sort-desc-button").addClass("active");
  } else {
    $(".js-sort-asc-button").addClass("active");
  }

  $(".js-sort-values").on("change", function () {
    location.href =
      location.protocol +
      "//" +
      location.host +
      location.pathname +
      "?by=" +
      $(this).val();
  });

  $(".js-sort-button").on("click", function () {
    currentUrl = new URL(location.href);
    params = new URLSearchParams(currentUrl.search);
    params.set("order", $(this).data("sort"));
    currentUrl.search = params;
    location.href = currentUrl;
  });
});
