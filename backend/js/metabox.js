function MetaboxController() {
  return {
    userDropDown: false,
    changeTab(e) {
      const current = e.target;
      const tab = current.getAttribute("data-tab");

      if (!current.classList.contains("active")) {
        document
          .querySelector(".worker_settings_tab.active")
          .classList.remove("active");
        current.classList.add("active");
      }

      console.log(tab);
    },
  };
}
