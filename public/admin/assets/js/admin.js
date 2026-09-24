'use strict';

(function () {
  const config = window.ADMIN_CONFIG || { locale: 'en', routes: {}, messages: {} };

  // ---------- Helpers ----------
  const getToken = () => {
    const meta = document.querySelector('meta[name="csrf-token"]');
    return meta ? meta.content : '';
  };

  const postJson = async (url, data = {}) => {
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'X-CSRF-TOKEN': getToken(),
        'X-Requested-With': 'XMLHttpRequest',
      },
      body: JSON.stringify(data),
    });

    let payload = null;
    try {
      payload = await response.json();
    } catch (e) {
      payload = null;
    }

    return { ok: response.ok, status: response.status, payload };
  };

  const showToast = (message, type = 'success') => {
    const icons = {
      success: 'ti-circle-check',
      danger: 'ti-alert-circle',
      warning: 'ti-alert-triangle',
      info: 'ti-info-circle',
    };

    const container = document.createElement('div');
    container.className = `toast-container position-fixed top-0 ${document.dir === 'rtl' ? 'start-0' : 'end-0'} p-3`;
    container.style.zIndex = 1090;
    container.innerHTML = `
      <div class="toast admin-toast" role="alert" aria-live="assertive" aria-atomic="true" data-type="${type}">
        <div class="d-flex align-items-center gap-2">
          <span class="admin-toast-icon"><i class="ti ${icons[type] || icons.info}"></i></span>
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>`;
    document.body.appendChild(container);
    const toastEl = container.querySelector('.toast');
    const toast = new bootstrap.Toast(toastEl, { delay: 3500 });
    toast.show();
    toastEl.addEventListener('hidden.bs.toast', () => container.remove());
  };
  window.adminToast = showToast;

  // ---------- Language switcher (slide toggle) ----------
  document.querySelectorAll('[data-lang-toggle]').forEach((toggle) => {
    toggle.addEventListener('click', async (event) => {
      if (!config.routes.langSwitch) return;

      const option = event.target.closest('[data-lang]');
      const target = option ? option.getAttribute('data-lang') : (config.locale === 'ar' ? 'en' : 'ar');
      const current = toggle.getAttribute('data-active');

      if (!target || target === current || toggle.hasAttribute('data-disabled')) return;

      toggle.setAttribute('data-disabled', '');
      try {
        await postJson(config.routes.langSwitch, { locale: target });
        window.location.reload();
      } catch (e) {
        toggle.removeAttribute('data-disabled');
        showToast(config.messages.networkError || 'Network error', 'danger');
      }
    });
  });

  // ---------- Sidebar ----------
  // Placeholder links ("#!") must not keep focus/highlight after being clicked.
  document.querySelectorAll('#miniSidebar a[href="#!"], .offcanvasNav a[href="#!"]').forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      event.currentTarget.blur();
    });
  });

  // Only the item matching the current URL stays highlighted.
  const currentUrl = window.location.href.split('#')[0];
  document.querySelectorAll('#miniSidebar .nav-link.active, .offcanvasNav .nav-link.active').forEach((link) => {
    if ((link.href || '').split('#')[0] !== currentUrl) {
      link.classList.remove('active');
    }
  });

  // ---------- Logout ----------
  document.querySelectorAll('[data-admin-logout]').forEach((link) => {
    link.addEventListener('click', async (event) => {
      event.preventDefault();
      if (!config.routes.logout) return;
      const { payload } = await postJson(config.routes.logout);
      const redirect = (payload && payload.data && payload.data.redirect) || '/admin/login';
      window.location.href = redirect;
    });
  });

  // ---------- AJAX Login ----------
  const loginForm = document.getElementById('adminLoginForm');
  if (loginForm) {
    const alertBox = document.getElementById('loginAlert');
    const alertMessage = document.getElementById('loginAlertMessage');
    const submitBtn = document.getElementById('loginSubmitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    const showAlert = (message) => {
      alertMessage.textContent = message;
      alertBox.classList.remove('d-none');
    };
    const hideAlert = () => alertBox.classList.add('d-none');

    loginForm.addEventListener('submit', async (event) => {
      event.preventDefault();
      hideAlert();

      if (!loginForm.checkValidity()) {
        loginForm.classList.add('was-validated');
        return;
      }

      const formData = new FormData(loginForm);
      submitBtn.disabled = true;
      btnText.classList.add('d-none');
      btnLoading.classList.remove('d-none');

      try {
        const { ok, payload } = await postJson(loginForm.action, {
          email: formData.get('email'),
          password: formData.get('password'),
          remember: formData.get('remember') === 'on',
        });

        if (ok && payload && payload.data && payload.data.redirect) {
          showToast(payload.message || 'OK', 'success');
          setTimeout(() => {
            window.location.href = payload.data.redirect;
          }, 400);
        } else {
          showAlert((payload && payload.message) || 'Error');
        }
      } catch (e) {
        showAlert('Network error');
      } finally {
        submitBtn.disabled = false;
        btnText.classList.remove('d-none');
        btnLoading.classList.add('d-none');
      }
    });

    ['input', 'change'].forEach((evt) =>
      loginForm.addEventListener(evt, () => {
        hideAlert();
        loginForm.classList.remove('was-validated');
      })
    );
  }

  // ---------- Dashboard stats (AJAX) ----------
  const statsContainer = document.querySelector('[data-stats-url]');
  if (statsContainer) {
    (async () => {
      try {
        const response = await fetch(statsContainer.getAttribute('data-stats-url'), {
          headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
        });
        const body = await response.json();
        const data = body && body.data ? body.data : null;
        if (!data) return;

        const formatter = new Intl.NumberFormat(config.locale === 'ar' ? 'ar-EG' : 'en-US');
        statsContainer.querySelectorAll('[data-stat]').forEach((el) => {
          const key = el.getAttribute('data-stat');
          if (data[key] !== undefined) {
            el.textContent = formatter.format(data[key]);
          }
        });
      } catch (e) {
        /* keep placeholders */
      }
    })();
  }
})();
