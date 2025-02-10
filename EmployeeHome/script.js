document.addEventListener("DOMContentLoaded", () => {
  // Find all checkboxes that control task flags
  const flagCheckboxes = document.querySelectorAll(".flag-checkbox");

  flagCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", (e) => {
      // Identify the type of flag (Under-Resourced or Needs Training)
      const isUnderResourced = e.target.classList.contains("underResourced");
      const flagType = isUnderResourced ? "Under-Resourced" : "Needs Training";

      if (e.target.checked) {
        console.log(`${flagType} flag is now ON.`);
      } else {
        console.log(`${flagType} flag is now OFF.`);
      }
    });
  });
});
