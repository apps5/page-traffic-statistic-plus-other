(function () {
  const typeSelect = document.getElementsByName("type_val");

  if (!typeSelect.length) {
      console.error("Не найден элемент с name='type_val'");
      return;
  }

  typeSelect[0].addEventListener("change", function () {
      const selectedValue = typeSelect[0].value;
      const formElements = document.querySelectorAll("input, button");

      formElements.forEach(element => {
          if (element.hasAttribute("name")) {
              const fieldName = element.getAttribute("name");
              const parent = element.closest("p");

              if (new RegExp(`_${selectedValue}\\b`).test(fieldName)) {
                  parent.style.display = "block";
                  if (parent && parent.nextElementSibling && parent.nextElementSibling.tagName === "P") {
                    parent.nextElementSibling.style.display = "block";
                  }
              } else {
                  parent.style.display = "none";
                  if (parent && parent.nextElementSibling && parent.nextElementSibling.tagName === "P") {
                      if (parent.nextElementSibling.innerText.trim() === "") {
                        parent.nextElementSibling.style.display = "none";
                      }
                  }
              }
          }
      });
  });

  typeSelect[0].dispatchEvent(new Event("change"));
})();

