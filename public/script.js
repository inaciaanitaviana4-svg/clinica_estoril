/* ===================================
   CLÍNICA ESTORIL - JAVASCRIPT
   ==================================== */

   
// Aguarda o carregamento do DOM
document.addEventListener("DOMContentLoaded", function () {
    // ===== MENU MOBILE =====
    initMobileMenu();

    // ===== BOTÃO VOLTAR AO TOPO =====
    initBackToTop();

    // ===== SCROLL SUAVE =====
    initSmoothScroll();

    // ===== HEADER FIXO COM SOMBRA =====
    initHeaderScroll();

    // ===== FAQ ACCORDION =====
    initFAQ();

    // ===== FORMULÁRIO DE CONTACTO =====
    initContactForm();

    // ===== ANIMAÇÕES AO SCROLL =====
    initScrollAnimations();
});

// ===== MENU MOBILE =====
function initMobileMenu() {
    const menuToggle = document.querySelector(".mobile-menu-toggle");
    const mobileMenu = document.querySelector(".mobile-menu");

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("active");

            // Anima o botão hamburger
            const spans = menuToggle.querySelectorAll("span");
            if (mobileMenu.classList.contains("active")) {
                spans[0].style.transform = "rotate(45deg) translate(5px, 5px)";
                spans[1].style.opacity = "0";
                spans[2].style.transform =
                    "rotate(-45deg) translate(5px, -5px)";
            } else {
                spans[0].style.transform = "none";
                spans[1].style.opacity = "1";
                spans[2].style.transform = "none";
            }
        });

        // Fecha o menu ao clicar em um link
        const mobileLinks = document.querySelectorAll(".mobile-link");
        mobileLinks.forEach((link) => {
            link.addEventListener("click", function () {
                mobileMenu.classList.remove("active");
                const spans = menuToggle.querySelectorAll("span");
                spans[0].style.transform = "none";
                spans[1].style.opacity = "1";
                spans[2].style.transform = "none";
            });
        });

        // Fecha o menu ao clicar fora
        document.addEventListener("click", function (e) {
            if (
                !menuToggle.contains(e.target) &&
                !mobileMenu.contains(e.target)
            ) {
                mobileMenu.classList.remove("active");
                const spans = menuToggle.querySelectorAll("span");
                spans[0].style.transform = "none";
                spans[1].style.opacity = "1";
                spans[2].style.transform = "none";
            }
        });
    }
}

// ===== BOTÃO VOLTAR AO TOPO =====
function initBackToTop() {
    const backToTopBtn = document.getElementById("backToTop");

    if (backToTopBtn) {
        // Mostra/oculta o botão baseado no scroll
        window.addEventListener("scroll", function () {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add("visible");
            } else {
                backToTopBtn.classList.remove("visible");
            }
        });

        // Ação do clique
        backToTopBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }
}

// ===== SCROLL SUAVE =====
function initSmoothScroll() {
    // Scroll suave para links âncora
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            const href = this.getAttribute("href");

            // Ignora # sozinho
            if (href === "#") {
                e.preventDefault();
                return;
            }

            const target = document.querySelector(href);

            if (target) {
                e.preventDefault();

                const headerHeight =
                    document.querySelector(".header").offsetHeight;
                const targetPosition = target.offsetTop - headerHeight - 20;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
            }
        });
    });
}

// ===== HEADER FIXO COM SOMBRA =====
function initHeaderScroll() {
    const header = document.querySelector(".header");

    if (header && !header.classList.contains("header-simple")) {
        window.addEventListener("scroll", function () {
            if (window.pageYOffset > 100) {
                header.style.boxShadow = "0 4px 16px rgba(0, 0, 0, 0.12)";
            } else {
                header.style.boxShadow = "0 2px 8px rgba(0, 0, 0, 0.08)";
            }
        });
    }
}

// ===== FAQ ACCORDION =====
function initFAQ() {
    const faqQuestions = document.querySelectorAll(".faq-question");

    faqQuestions.forEach((question) => {
        question.addEventListener("click", function () {
            const faqItem = this.parentElement;
            const isActive = faqItem.classList.contains("active");

            // Fecha todas as FAQs
            document.querySelectorAll(".faq-item").forEach((item) => {
                item.classList.remove("active");
            });

            // Abre a FAQ clicada se não estava ativa
            if (!isActive) {
                faqItem.classList.add("active");
            }
        });
    });
}

// ===== FORMULÁRIO DE CONTACTO =====
function initContactForm() {
    const contactForm = document.getElementById("contactForm");

    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();

            // Validação básica
            const name = document.getElementById("name").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const email = document.getElementById("email").value.trim();

            if (!name || !phone || !email) {
                showNotification(
                    "Por favor, preencha todos os campos obrigatórios.",
                    "error",
                );
                return;
            }

            // Validação de email
            if (!isValidEmail(email)) {
                showNotification("Por favor, insira um email válido.", "error");
                return;
            }

            // Validação de telefone (básica)
            if (!isValidPhone(phone)) {
                showNotification(
                    "Por favor, insira um telefone válido.",
                    "error",
                );
                return;
            }

            // Simula envio do formulário
            const submitBtn = contactForm.querySelector(
                'button[type="submit"]',
            );
            const originalBtnText = submitBtn.innerHTML;

            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            submitBtn.disabled = true;

            // Simula delay de envio
            setTimeout(() => {
                // Sucesso
                showNotification(
                    "Pedido de agendamento enviado com sucesso! Entraremos em contacto em breve.",
                    "success",
                );
                contactForm.reset();

                // Restaura o botão
                submitBtn.innerHTML = originalBtnText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }
}

// Função para validar email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Função para validar telefone (aceita diversos formatos portugueses)
function isValidPhone(phone) {
    // Remove espaços e caracteres especiais para validação
    const cleanPhone = phone.replace(/[\s\-\(\)]/g, "");

    // Valida números portugueses (9 dígitos começando com 2, 9 ou +351)
    const phoneRegex = /^(\+351)?[2-9]\d{8}$/;
    return phoneRegex.test(cleanPhone);
}

// ===== SISTEMA DE NOTIFICAÇÕES =====
function showNotification(message, type = "info") {
    // Remove notificação existente
    const existingNotification = document.querySelector(".notification");
    if (existingNotification) {
        existingNotification.remove();
    }

    // Cria nova notificação
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;

    // Define o ícone baseado no tipo
    let icon = "fa-info-circle";
    if (type === "success") icon = "fa-check-circle";
    if (type === "error") icon = "fa-exclamation-circle";
    if (type === "warning") icon = "fa-exclamation-triangle";

    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas ${icon}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;

    // Adiciona estilos inline (pode ser movido para CSS)
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        min-width: 300px;
        max-width: 500px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.16);
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
    `;

    // Cores baseadas no tipo
    if (type === "success") {
        notification.style.borderLeft = "4px solid #00a86b";
    } else if (type === "error") {
        notification.style.borderLeft = "4px solid #ff6b35";
    } else if (type === "warning") {
        notification.style.borderLeft = "4px solid #ffd700";
    } else {
        notification.style.borderLeft = "4px solid #0066cc";
    }

    document.body.appendChild(notification);

    // Remove automaticamente após 5 segundos
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = "slideOutRight 0.3s ease";
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

// Adiciona estilos de animação para notificações
const notificationStyles = document.createElement("style");
notificationStyles.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }

    .notification-content {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
    }

    .notification-content i {
        font-size: 24px;
        color: #0066cc;
    }

    .notification-success .notification-content i {
        color: #00a86b;
    }

    .notification-error .notification-content i {
        color: #ff6b35;
    }

    .notification-warning .notification-content i {
        color: #ffd700;
    }

    .notification-close {
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        padding: 4px;
        transition: color 0.3s ease;
    }

    .notification-close:hover {
        color: #333;
    }

    @media (max-width: 768px) {
        .notification {
            right: 10px;
            left: 10px;
            max-width: calc(100% - 20px);
            min-width: auto;
        }
    }
`;
document.head.appendChild(notificationStyles);

// ===== ANIMAÇÕES AO SCROLL =====
function initScrollAnimations() {
    // Observa elementos quando entram na viewport
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.animation = "fadeInUp 0.6s ease forwards";
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observa cards e elementos animáveis
    const animatableElements = document.querySelectorAll(`
        .feature-card,
        .specialty-card,
        .service-detailed-card,
        .team-card,
        .differential-card,
        .mission-card,
        .stat-box
    `);

    animatableElements.forEach((el, index) => {
        el.style.opacity = "0";
        el.style.animationDelay = `${index * 0.1}s`;
        observer.observe(el);
    });
}

// ===== CONTADOR ANIMADO =====
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16); // 60fps
    let current = start;

    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target.toLocaleString("pt-PT");
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString("pt-PT");
        }
    }, 16);
}

// Anima contadores quando visíveis
const counters = document.querySelectorAll(".stat-number");
if (counters.length > 0) {
    const counterObserver = new IntersectionObserver(
        function (entries) {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const target = parseInt(
                        entry.target.textContent.replace(/\D/g, ""),
                    );
                    animateCounter(entry.target, target);
                    counterObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 },
    );

    counters.forEach((counter) => counterObserver.observe(counter));
}

// ===== VALIDAÇÃO DE DATA NO FORMULÁRIO =====
const dateInput = document.getElementById("date");
if (dateInput) {
    // Define data mínima como hoje
    const today = new Date().toISOString().split("T")[0];
    dateInput.setAttribute("min", today);

    // Define data máxima como 90 dias a partir de hoje
    const maxDate = new Date();
    maxDate.setDate(maxDate.getDate() + 90);
    dateInput.setAttribute("max", maxDate.toISOString().split("T")[0]);
}

// ===== MÁSCARAS DE INPUT =====
function applyPhoneMask(input) {
    input.addEventListener("input", function (e) {
        let value = e.target.value.replace(/\D/g, "");

        // Formata número português: +351 XXX XXX XXX ou XXX XXX XXX
        if (value.length <= 9) {
            value = value.replace(/(\d{3})(\d{3})(\d{3})/, "$1 $2 $3");
        } else if (value.length <= 12) {
            value = value.replace(
                /(\d{3})(\d{3})(\d{3})(\d{3})/,
                "+$1 $2 $3 $4",
            );
        }

        e.target.value = value;
    });
}

const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach((input) => applyPhoneMask(input));

// ===== PREVENÇÃO DE ENVIO MÚLTIPLO DE FORMULÁRIOS =====
document.querySelectorAll("form").forEach((form) => {
    form.addEventListener("submit", function () {
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            setTimeout(() => {
                submitBtn.disabled = false;
            }, 3000);
        }
    });
});

// ===== LAZY LOADING DE IMAGENS =====
if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute("data-src");
                }
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
        imageObserver.observe(img);
    });
}

// ===== DARK MODE (OPCIONAL - COMENTADO) =====
/*
function initDarkMode() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    if (isDarkMode) {
        document.body.classList.add('dark-mode');
    }

    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
        });
    }
}
*/

// ===== CONSOLE MESSAGE =====
console.log(
    "%c🏥 Clínica Estoril",
    "font-size: 24px; font-weight: bold; color: #0066cc;",
);
console.log("%cSite desenvolvido com HTML5, CSS3 e JavaScript", "color: #666;");
console.log("%cVersão: 1.0.0", "color: #999;");

// ===== DETECÇÃO DE BROWSER ANTIGO =====
function checkBrowserCompatibility() {
    // Verifica se o navegador suporta recursos modernos
    const isModernBrowser =
        "IntersectionObserver" in window &&
        "fetch" in window &&
        "Promise" in window;

    if (!isModernBrowser) {
        console.warn(
            "Navegador desatualizado detectado. Algumas funcionalidades podem não funcionar corretamente.",
        );
    }
}

checkBrowserCompatibility();

// ===== PREVENÇÃO DE ZOOM EM MOBILE (iOS) =====
document.addEventListener("gesturestart", function (e) {
    e.preventDefault();
});

// ===== PERFORMANCE: Debounce para eventos de scroll e resize =====
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Aplica debounce em eventos pesados
window.addEventListener(
    "resize",
    debounce(function () {
        // Código a executar no resize
        console.log("Window resized");
    }, 250),
);

// ===== ACESSIBILIDADE: Navegação por teclado =====
document.addEventListener("keydown", function (e) {
    // ESC fecha modais e menus
    if (e.key === "Escape") {
        const mobileMenu = document.querySelector(".mobile-menu");
        if (mobileMenu && mobileMenu.classList.contains("active")) {
            mobileMenu.classList.remove("active");
        }
    }
});

// ===== ANALYTICS (Placeholder) =====
function trackEvent(category, action, label) {
    // Integração com Google Analytics ou outra ferramenta
    console.log("Event tracked:", category, action, label);

    // Exemplo: gtag('event', action, { 'event_category': category, 'event_label': label });
}

// Rastreia cliques em botões importantes
document.querySelectorAll(".btn-primary").forEach((btn) => {
    btn.addEventListener("click", function () {
        trackEvent("Button", "Click", this.textContent.trim());
    });
});

// ===== PRINT: Otimização para impressão =====
window.addEventListener("beforeprint", function () {
    console.log("Preparando página para impressão...");
    // Código para otimizar a página antes de imprimir
});

window.addEventListener("afterprint", function () {
    console.log("Impressão concluída.");
});

// ===== FIM DO SCRIPT =====
console.log("✅ Script carregado com sucesso!");

function badge_estados_exames(estado) {
    let cor = "#000000"; // Cor padrão
    let estado_nome = "";
    switch (estado) {
        case "PENDENTE":
            cor = "#f59e0b";
            estado_nome = "Pendente";
            break;

        case "REALIZADO":
            cor = "#10b981";
            estado_nome = "Realizado";
            break;
    }

    return `<span style='padding: 4px 8px; background-color: ${cor}; color: white; border-radius: 4px;'>${estado_nome}</span>`;
}

function badge_todos_estados($estado) {
    $cor = "#000000"; // Cor padrão
    $estado_nome = $estado; // Exibe o estado original por padrão
    switch ($estado) {
        case "pendente":
            $cor = "#f59e0b";
            $estado_nome = "Pendente";
            break;
        case "agendada":
            $cor = "#6366f1";
            $estado_nome = "Agendada";
            break;
        case "confirmada":
            $cor = "#3b82f6";
            $estado_nome = "Confirmada";
            break;
        case "cancelada":
        case "cancelado":
            $cor = "#ef4444";
            $estado_nome = "Cancelada";
            break;

        case "em_andamento":
            $cor = "#8b5cf6";
            $estado_nome = "Em Andamento";
            break;
        case "em_espera":
            $cor = "#6b7280";
            $estado_nome = "Em Espera";
            break;
        case "sucesso":
            $cor = "#10b981";
            $estado_nome = "Sucesso";
            break;
        case "concluida":
            $cor = "#10b981";
            $estado_nome = "Concluída";
            break;
    }

    return `<span style='padding: 4px 8px; background-color: ${$cor}; color: white; border-radius: 4px;'>${$estado_nome}</span>`;
}

function obterImagemBase64(url) {
  return new Promise((resolve, reject)=>{
    var img = new Image();
    
    img.setAttribute('crossOrigin', 'anonymous');
    
    img.onload = function () {
    var canvas = document.createElement("canvas");
    canvas.width = this.width;
    canvas.height = this.height;
    var ctx = canvas.getContext("2d");
    ctx.drawImage(this, 0, 0);
    var dataURL = canvas.toDataURL("image/png");
    resolve(dataURL);
    };
    
    img.onerror = function(e) {
    reject("The image could not be loaded or CORS is blocking the request.", e);
    }
    
    img.src = url;
  });
}