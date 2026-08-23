(() => {
  "use strict";

  let modalInstance = null;
  let activeResolve = null;

  const settle = (result) => {
    if (typeof activeResolve === "function") {
      activeResolve(result);
      activeResolve = null;
    }
  };

  document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("adminConfirmModal");
    if (!el) return;

    modalInstance = new bootstrap.Modal(el);

    el.addEventListener("hidden.bs.modal", () => settle(false));

    document.getElementById("adminConfirmOkBtn")?.addEventListener("click", () => {
      settle(true);
      modalInstance.hide();
    });
  });

  window.adminConfirm = ({ title = "", text = "", confirmText = null } = {}) =>
    new Promise((resolve) => {
      if (!modalInstance || typeof window.confirm === "undefined") {
        resolve(window.confirm(text));
        return;
      }

      const titleEl = document.getElementById("adminConfirmTitle");
      const textEl = document.getElementById("adminConfirmText");
      const okEl = document.getElementById("adminConfirmOkBtn");

      if (titleEl) titleEl.textContent = title;
      if (textEl) textEl.textContent = text;
      if (okEl && confirmText) okEl.querySelector("span").textContent = confirmText;

      settle(false);
      activeResolve = resolve;
      modalInstance.show();
    });
})();
