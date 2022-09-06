function Settings() {
  return {
    accountType: false,
    accountTypeText: document.getElementById("accountTypeText"),
    accountTypeInput: document.getElementById("accountTypeInput"),
    accountTypeLabel: null,
    worker: true,
    changeAccountType(e) {
      const current = e.target;
      const type = current.getAttribute("data-type");

      if (type == "worker") {
        this.worker = true;
      } else {
        this.worker = false;
      }

      // console.log("page", page);
      // set input value
      this.accountTypeInput.value = type;
      // get input title
      this.accountTypeLabel = current.textContent;
      this.accountTypeLabel = this.accountTypeLabel.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.accountTypeText.innerText = this.accountTypeLabel;

      // hide dropdown
      this.accountType = false;
    },
  };
}
