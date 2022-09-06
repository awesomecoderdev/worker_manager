function Settings() {
  return {
    userDropDown: false,
    productDropDown: false,
    root: document.getElementsByTagName("html")[0],
    selectUser: document.getElementById("selectUser"),
    userSelect: document.getElementById("userSelect"),
    selectTitle: null,
    selectProduct: document.getElementById("selectProduct"),
    productSelect: document.getElementById("productSelect"),
    selectProductTitle: null,
    accountPageDropDown: false,
    selectAccountPage: document.getElementById("selectAccountPage"),
    accountPageSelect: document.getElementById("accountPageSelect"),
    selectAccountPageTitle: null,
    changeUserPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");

      //   console.log("pages", page);
      // set input value
      this.selectUser.value = page;
      // get input title
      this.selectTitle = current.textContent;
      this.selectTitle = this.selectTitle.replace(/[^a-zA-Z0-9@]+/, "");

      // set input value
      this.userSelect.innerText = this.selectTitle;

      // hide dropdown
      this.userDropDown = false;
    },
    changeWooProduct(e) {
      const current = e.target;
      const product = current.getAttribute("data-product");

      //   console.log("products", product);
      // set input value
      this.selectProduct.value = product;
      // get input title
      this.selectProductTitle = current.textContent;
      this.selectProductTitle = this.selectProductTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );

      // set input value
      this.productSelect.innerText = this.selectProductTitle;

      // hide dropdown
      this.productDropDown = false;
    },
    changeAccountPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.selectAccountPage.value = page;
      // get input title
      this.selectAccountPageTitle = current.textContent;
      this.selectAccountPageTitle = this.selectAccountPageTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.accountPageSelect.innerText = this.selectAccountPageTitle;
      // hide dropdown
      this.accountPageDropDown = false;
    },
    accountLoginPageDropDown: false,
    lgoinText: document.getElementById("lgoinText"),
    changeLoginInput: document.getElementById("changeLoginInput"),
    changeLoginPageTitle: null,
    changeLoginPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.changeLoginInput.value = page;
      // get input title
      this.changeLoginPageTitle = current.textContent;
      this.changeLoginPageTitle = this.changeLoginPageTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.lgoinText.innerText = this.changeLoginPageTitle;
      // hide dropdown
      this.accountLoginPageDropDown = false;
    },
    accountRegisterPageDropDown: false,
    registerText: document.getElementById("registerText"),
    changeRegisterInput: document.getElementById("changeRegisterInput"),
    changeRegisterPageTitle: null,
    changeRegisterPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.changeRegisterInput.value = page;
      // get input title
      this.changeRegisterPageTitle = current.textContent;
      this.changeRegisterPageTitle = this.changeRegisterPageTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.registerText.innerText = this.changeRegisterPageTitle;
      // hide dropdown
      this.accountRegisterPageDropDown = false;
    },
    accountResetPageDropDown: false,
    resetText: document.getElementById("resetText"),
    changeResetInput: document.getElementById("changeResetInput"),
    changeResetPageTitle: null,
    changeResetPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.changeResetInput.value = page;
      // get input title
      this.changeResetPageTitle = current.textContent;
      this.changeResetPageTitle = this.changeResetPageTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.resetText.innerText = this.changeResetPageTitle;
      // hide dropdown
      this.accountResetPageDropDown = false;
    },
    singleWorker: false,
    singleWorkerText: document.getElementById("singleWorkerText"),
    changeSingleWorkerInput: document.getElementById("changeSingleWorkerInput"),
    changeResetPageTitle: null,
    changeWorkerPage(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.changeSingleWorkerInput.value = page;
      // get input title
      this.changeResetPageTitle = current.textContent;
      this.changeResetPageTitle = this.changeResetPageTitle.replace(
        /[^a-zA-Z0-9@]+/,
        ""
      );
      // set input value
      this.singleWorkerText.innerText = this.changeResetPageTitle;
      // hide dropdown
      this.singleWorker = false;
    },
    acfGroup: false,
    acfGroupText: document.getElementById("acfGroupText"),
    selectAcfGroup: document.getElementById("selectAcfGroup"),
    acfGroupTitle: null,
    changeAcfGroup(e) {
      const current = e.target;
      const page = current.getAttribute("data-page");
      // console.log("page", page);
      // set input value
      this.selectAcfGroup.value = page;
      // get input title
      this.acfGroupTitle = current.textContent;
      this.acfGroupTitle = this.acfGroupTitle.replace(/[^a-zA-Z0-9@]+/, "");
      // set input value
      this.acfGroupText.innerText = this.acfGroupTitle;
      // hide dropdown
      this.acfGroup = false;
    },
  };
}
