// CONTADOR DE CARACTERES
const textarea = document.getElementById('message');
const contador = document.getElementById('contador');

function atualizarContador() {
    const atual = textarea.value.length;
    contador.textContent = atual + '/500';
    if (atual >= 450) {
        contador.style.color = '#e67e22';
    } else if (atual >= 500) {
        contador.style.color = '#e74c3c';
    } else {
        contador.style.color = '#2a2a2a';
    }
    // Modo escuro
    if (document.body.classList.contains('dark-mode')) {
        contador.style.color = atual >= 500 ? '#e74c3c' : atual >= 450 ? '#f39c12' : '#ddd';
    }
}

if (textarea) {
    textarea.addEventListener('input', atualizarContador);
    atualizarContador(); // executa na carga da página
}

// Garantir que a aba Contato fique ativa após envio
if (window.isPostSent) {
    document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
    document.querySelector('.tab-link[href="#contato"]').classList.add('active');
    document.querySelectorAll('.content-section').forEach(s => s.classList.remove('active'));
    document.getElementById('contato').classList.add('active');
}

/* SEU JAVASCRIPT ORIGINAL 100% PRESERVADO */
let currentParticipant = 0;
const participantCards = document.querySelectorAll('.participant-card');
const totalParticipants = participantCards.length;
let isPaused = false;
let currentUtterance = null;
let tamanhoFonte = 100;

function updateCarousel() {
    participantCards.forEach((c, i) => {
        c.classList.remove('active', 'prev');
        if (i === currentParticipant) c.classList.add('active');
        else if (i === (currentParticipant - 1 + totalParticipants) % totalParticipants) c.classList.add('prev');
    });
}
function changeParticipant(dir) {
    currentParticipant = (currentParticipant + dir + totalParticipants) % totalParticipants;
    updateCarousel();
}
const arrowLeft = document.querySelector('.carousel-arrow.left');
const arrowRight = document.querySelector('.carousel-arrow.right');

if (arrowLeft) arrowLeft.addEventListener('click', () => changeParticipant(-1));
if (arrowRight) arrowRight.addEventListener('click', () => changeParticipant(1));

if (participantCards.length > 0) updateCarousel();

function aumentarFonte() {
    if (tamanhoFonte < 160) {
        tamanhoFonte += 10;
        document.documentElement.style.fontSize = tamanhoFonte + '%';
    }
}
function diminuirFonte() {
    if (tamanhoFonte > 50) {
        tamanhoFonte -= 10;
        document.documentElement.style.fontSize = tamanhoFonte + '%';
    }
}
function toggleDarkMode() {
    const isDark = document.body.classList.toggle('dark-mode');
    document.querySelectorAll('*:not(.no-dark):not(.no-dark *)')
        .forEach(el => el.style.color = isDark ? '#e0e0e0' : '#2a2a2a');
    ['header', '.menu', '.content-section', '.contact-form', '.participant-container',
        '.participant-card', '.participant-info', '.carousel-arrow', 'footer',
        '.narrator-box', '.info-subsection'].forEach(s => document.querySelectorAll(s).forEach(e => e.classList.toggle('dark-mode', isDark)));
    const btn = document.getElementById('accessibility-float-btn');
    if (btn) btn.classList.toggle('dark-mode', isDark);
}
function toggleContraste() { document.body.classList.toggle('alto-contraste'); }
function aplicarFiltro(t) {
    document.body.classList.remove('filtro-protanopia', 'filtro-deuteranopia', 'filtro-tritanopia');
    if (t !== 'none') document.body.classList.add('filtro-' + t);
}
function resetAccessibility() {
    tamanhoFonte = 100;
    document.documentElement.style.fontSize = '100%';
    const rm = ['dark-mode', 'alto-contraste', 'filtro-protanopia', 'filtro-deuteranopia', 'filtro-tritanopia'];
    rm.forEach(c => document.body.classList.remove(c));
    document.querySelectorAll('.dark-mode').forEach(e => e.classList.remove('dark-mode'));
    const sel = document.getElementById('filtros'); if (sel) sel.value = 'none';
}

function createPanel() {
    if (document.getElementById('accessibility-panel')) return;
    const p = document.createElement('div');
    p.id = 'accessibility-panel';
    p.innerHTML = `
        <div class="accessibility-header">
            <h3>Acessibilidade</h3>
            <button onclick="closePanel()" aria-label="Fechar">X</button>
        </div>
        <div class="accessibility-content">
            <button onclick="toggleDarkMode()">Modo Escuro / Claro</button>
            <button onclick="aumentarFonte()">Aumentar Fonte</button>
            <button onclick="diminuirFonte()">Diminuir Fonte</button>
            <button onclick="toggleContraste()">Alto Contraste</button>
            <select id="filtros" onchange="aplicarFiltro(this.value)">
                <option value="none">Filtros para Daltônicos: Nenhum</option>
                <option value="protanopia">Protanopia</option>
                <option value="deuteranopia">Deuteranopia</option>
                <option value="tritanopia">Tritanopia</option>
            </select>
            <button onclick="resetAccessibility()">Redefinir</button>
        </div>`;
    document.body.appendChild(p);
}
function toggleAccessibilityPanel() {
    const panel = document.getElementById('accessibility-panel');
    if (panel) {
        panel.classList.toggle('active');
    } else {
        createPanel();
        setTimeout(() => document.getElementById('accessibility-panel').classList.add('active'), 10);
    }
}
function closePanel() {
    document.getElementById('accessibility-panel')?.classList.remove('active');
}

function startReading() {
    speechSynthesis.cancel(); isPaused = false;
    const btn = document.getElementById('pauseResumeButton');
    btn.innerHTML = 'Pausar Leitura'; btn.setAttribute('aria-label', 'Pausar leitura');
    const sec = document.querySelector('.content-section.active');
    if (!sec) return;
    const txt = sec.innerText;
    currentUtterance = new SpeechSynthesisUtterance(txt);
    currentUtterance.lang = 'pt-BR'; currentUtterance.rate = 1; currentUtterance.pitch = 1;
    currentUtterance.onend = () => { isPaused = false; btn.innerHTML = 'Pausar Leitura'; };
    speechSynthesis.speak(currentUtterance);
}
function pauseResumeReading() {
    if (!currentUtterance) return;
    const btn = document.getElementById('pauseResumeButton');
    if (isPaused) { speechSynthesis.resume(); isPaused = false; btn.innerHTML = 'Pausar Leitura'; }
    else { speechSynthesis.pause(); isPaused = true; btn.innerHTML = 'Retomar Leitura'; }
}

document.querySelectorAll('.tab-link').forEach(l => l.addEventListener('click', function (e) {
    e.preventDefault();
    if (this.classList.contains('active')) return;
    speechSynthesis.cancel(); isPaused = false;
    const btn = document.getElementById('pauseResumeButton');
    btn.innerHTML = 'Pausar Leitura';
    const cur = document.querySelector('.content-section.active');
    const id = this.getAttribute('href').substring(1);
    const nxt = document.getElementById(id);
    document.querySelectorAll('.tab-link').forEach(t => t.classList.remove('active'));
    this.classList.add('active');
    if (cur) cur.classList.remove('active');
    setTimeout(() => { nxt.classList.add('active'); }, 200);
}));

const footer = document.getElementById('footer');
window.addEventListener('scroll', () => {
    const scrollPosition = window.innerHeight + window.scrollY;
    const pageHeight = document.body.offsetHeight;
    if (scrollPosition >= pageHeight - 50) {
        footer.classList.add('show');
    } else {
        footer.classList.remove('show');
    }
});
