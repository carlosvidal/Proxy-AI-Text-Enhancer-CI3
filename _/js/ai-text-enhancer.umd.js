!(function (e, n) {
	"object" == typeof exports && "undefined" != typeof module
		? (module.exports = n())
		: "function" == typeof define && define.amd
		? define(n)
		: ((e =
				"undefined" != typeof globalThis
					? globalThis
					: e || self).AITextEnhancer = n());
})(this, function () {
	"use strict";
	const e = {
			en: {
				modalTrigger: "Enhance with AI",
				modalTitle: "Enhance your text",
				tools: {
					improve: "Improve",
					summarize: "Summarize",
					expand: "Expand",
					paraphrase: "Paraphrase",
					"more-formal": "More Formal",
					"more-casual": "More Casual",
					"chat-question": "Question",
					"chat-response": "Response",
					"chat-error": "Error",
				},
				actions: {
					copy: "Copy",
					use: "Use",
					edit: "Edit",
					retry: "Retry",
					insert: "Insert",
					replace: "Replace",
					generate: "Generate",
				},
				preview: { placeholder: "Enhanced text will appear here" },
				chat: {
					placeholder: "Ask a question about the product description...",
					question: "Question",
				},
				errors: {
					apiKey:
						"Error: API key not configured. Please provide a valid API key.",
					initialization: "Error initializing component:",
					request: "Error processing request:",
				},
			},
			es: {
				modalTrigger: "Mejorar con IA",
				modalTitle: "Mejora tu texto",
				tools: {
					improve: "Mejorar",
					summarize: "Resumir",
					expand: "Ampliar",
					paraphrase: "Parafrasear",
					"more-formal": "Más formal",
					"more-casual": "Más casual",
					"chat-question": "Pregunta",
					"chat-response": "Respuesta",
					"chat-error": "Error",
				},
				actions: {
					copy: "Copiar",
					use: "Usar",
					edit: "Editar",
					retry: "Reintentar",
					insert: "Insertar",
					replace: "Reemplazar",
					generate: "Generar",
				},
				preview: { placeholder: "El texto mejorado aparecerá aquí" },
				chat: {
					placeholder: "Haz una pregunta sobre la descripción del producto...",
					question: "Pregunta",
				},
				errors: {
					apiKey:
						"Error: API key no configurada. Por favor proporciona una API key válida.",
					initialization: "Error inicializando componente:",
					request: "Error procesando solicitud:",
				},
			},
			fr: {
				modalTrigger: "Améliorer avec IA",
				modalTitle: "Améliorez votre texte",
				tools: {
					improve: "Améliorer",
					summarize: "Résumer",
					expand: "Développer",
					paraphrase: "Paraphraser",
					"more-formal": "Plus Formel",
					"more-casual": "Plus Décontracté",
					"chat-question": "Question",
					"chat-response": "Réponse",
					"chat-error": "Erreur",
				},
				actions: {
					retry: "Réessayer",
					insert: "Insérer",
					replace: "Remplacer",
					generate: "Générer",
					copy: "Copier",
					use: "Utiliser",
					edit: "Éditer",
				},
				preview: { placeholder: "Le texte amélioré apparaîtra ici" },
				chat: {
					placeholder: "Posez une question sur la description du produit...",
					question: "Question",
				},
				errors: {
					apiKey:
						"Erreur : Clé API non configurée. Veuillez fournir une clé API valide.",
					initialization: "Erreur d'initialisation du composant :",
					request: "Erreur lors du traitement de la demande :",
				},
			},
			de: {
				modalTrigger: "Beschreibung Verbessern",
				modalTitle: "Verbessern Sie Ihre Beschreibung",
				tools: {
					improve: "Verbessern",
					summarize: "Zusammenfassen",
					expand: "Erweitern",
					paraphrase: "Umformulieren",
					"more-formal": "Formaler",
					"more-casual": "Lockerer",
					"chat-question": "Frage",
					"chat-response": "Antwort",
					"chat-error": "Fehler",
				},
				actions: {
					retry: "Wiederholen",
					insert: "Einfügen",
					replace: "Ersetzen",
					generate: "Generieren",
					copy: "Kopieren",
					use: "Verwenden",
					edit: "Bearbeiten",
				},
				preview: { placeholder: "Verbesserter Text erscheint hier" },
				chat: {
					placeholder: "Stellen Sie eine Frage zur Produktbeschreibung...",
					question: "Frage",
				},
				errors: {
					apiKey:
						"Fehler: API-Schlüssel nicht konfiguriert. Bitte geben Sie einen gültigen API-Schlüssel an.",
					initialization: "Fehler bei der Initialisierung der Komponente:",
					request: "Fehler bei der Verarbeitung der Anfrage:",
				},
			},
			pt: {
				modalTrigger: "Melhorar com IA",
				modalTitle: "Melhore sua texto",
				tools: {
					improve: "Melhorar",
					summarize: "Resumir",
					expand: "Expandir",
					paraphrase: "Parafrasear",
					"more-formal": "Mais Formal",
					"more-casual": "Mais Casual",
					"chat-question": "Pergunta",
					"chat-response": "Resposta",
					"chat-error": "Erro",
				},
				actions: {
					retry: "Tentar Novamente",
					insert: "Inserir",
					replace: "Substituir",
					generate: "Gerar",
					copy: "Copiar",
					use: "Usar",
					edit: "Editar",
				},
				preview: { placeholder: "O texto melhorado aparecerá aqui" },
				chat: {
					placeholder: "Faça uma pergunta sobre a descrição do produto...",
					question: "Pergunta",
				},
				errors: {
					apiKey:
						"Erro: Chave API não configurada. Por favor, forneça uma chave API válida.",
					initialization: "Erro ao inicializar componente:",
					request: "Erro ao processar solicitação:",
				},
			},
			it: {
				modalTrigger: "Migliorare con IA",
				modalTitle: "Migliorare il tuo testo",
				tools: {
					improve: "Migliorare",
					summarize: "Sommario",
					expand: "Espandere",
					paraphrase: "Parafrasare",
					"more-formal": "Più Formale",
					"more-casual": "Più Casual",
					"chat-question": "Domanda",
					"chat-response": "Risposta",
					"chat-error": "Errore",
				},
				actions: {
					retry: "Riprova",
					insert: "Inserire",
					replace: "Sostituire",
					generate: "Generare",
					copy: "Copiare",
					use: "Usare",
					edit: "Modificare",
				},
				preview: { placeholder: "Il testo migliorato apparirà qui" },
				chat: {
					placeholder: "Fai una domanda sulla descrizione del prodotto...",
					question: "Domanda",
				},
				errors: {
					apiKey:
						"Errore: Chiave API non configurata. Fornisci una chiave API valida.",
					initialization: "Errore inizializzazione componente:",
					request: "Errore elaborazione richiesta:",
				},
			},
		},
		n = (e) => {
			const n = {
				improve:
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <path d="m21.64 3.64-1.28-1.28a1.21 1.21 0 0 0-1.72 0L2.36 18.64a1.21 1.21 0 0 0 0 1.72l1.28 1.28a1.2 1.2 0 0 0 1.72 0L21.64 5.36a1.2 1.2 0 0 0 0-1.72Z"/>\n          <path d="m14 7 3 3"/>\n        </svg>\n      ',
				summarize:
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>\n          <path d="M9 10h6"/>\n        </svg>\n      ',
				expand:
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>\n          <path d="M9 10h6"/><path d="M12 7v6"/>\n        </svg>\n      ',
				paraphrase:
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <path d="M21 6H3"/><path d="M7 12H3"/><path d="M7 18H3"/>\n          <path d="M12 18a5 5 0 0 0 9-3 4.5 4.5 0 0 0-4.5-4.5c-1.33 0-2.54.54-3.41 1.41L11 14"/>\n          <path d="M11 10v4h4"/>\n        </svg>\n      ',
				"more-formal":
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>\n          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>\n        </svg>\n      ',
				"more-casual":
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <circle cx="12" cy="12" r="10"/>\n          <path d="M8 14s1.5 2 4 2 4-2 4-2"/>\n          <line x1="9" x2="9.01" y1="9" y2="9"/>\n          <line x1="15" x2="15.01" y1="9" y2="9"/>\n        </svg>\n      ',
				"chat-question":
					'\n      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>\n      </svg>\n    ',
				"chat-response":
					'\n      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n        <path d="M3 15a2 2 0 0 0 2 2h14l4 4V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"/>\n      </svg>\n    ',
				"chat-error":
					'\n      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n        <circle cx="12" cy="12" r="10"/>\n        <line x1="12" y1="8" x2="12" y2="12"/>\n        <line x1="12" y1="16" x2="12.01" y2="16"/>\n      </svg>\n    ',
			};
			return n[e] || n.improve;
		},
		t =
			"\n  :host {\n    --ai-primary: #3b82f6;\n    --ai-primary-hover: #2563eb;\n    --ai-secondary: #e5e7eb;\n    --ai-secondary-hover: #d1d5db;\n    --ai-text: #1f2937;\n    --ai-text-light: #6b7280;\n    --ai-border: #e5e7eb;\n    --ai-success: #10b981;\n    --ai-warning: #f59e0b;\n    --ai-error: #dc2626;\n    --ai-background: #ffffff;\n    --ai-background-light: #f9fafb;\n    \n    --ai-shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);\n    --ai-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);\n    --ai-shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);\n    \n    --ai-radius-sm: 0.375rem;\n    --ai-radius: 0.5rem;\n    --ai-radius-md: 0.75rem;\n    --ai-radius-lg: 1rem;\n    \n    --ai-font-sans: system-ui, -apple-system, sans-serif;\n    --ai-z-modal: 99999;\n    --ai-z-content: 100000;\n\n    /* Gradient colors */\n    --ai-gradient-start: #da22ff;\n    --ai-gradient-middle: #9733ee;\n    --ai-gradient-end: #da22ff;\n  }\n",
		o =
			"\n  @keyframes fadeIn {\n    from {\n      opacity: 0;\n      transform: translateY(10px);\n    }\n    to {\n      opacity: 1;\n      transform: translateY(0);\n    }\n  }\n\n  @keyframes blink {\n    0%, 100% { opacity: 1; }\n    50% { opacity: 0; }\n  }\n\n  @keyframes glow {\n    0% { background-position: 0 0; }\n    50% { background-position: 200% 0; }\n    100% { background-position: 0 0; }\n  }\n\n  @keyframes shake {\n    0%, 100% { transform: rotate(0deg); }\n    25% { transform: rotate(5deg); }\n    50% { transform: rotate(-5deg); }\n    75% { transform: rotate(5deg); }\n  }\n\n  @keyframes pulse {\n    0% { transform: scale(1); }\n    50% { transform: scale(1.05); }\n    100% { transform: scale(1); }\n  }\n",
		r =
			"\n  .preview {\n    flex: 1;\n    overflow-y: auto;\n    background: var(--ai-background);\n    border-radius: var(--ai-radius);\n  }\n\n  .response-tool {\n    font-weight: 500;\n    color: var(--ai-text);\n    display: flex;\n    align-items: center;\n    gap: 0.5rem;\n  }\n\n  .response-timestamp {\n    color: var(--ai-text-light);\n    font-size: 0.875rem;\n  }\n\n  .response-action.primary {\n    background: var(--ai-primary);\n    color: white;\n  }\n\n  .response-action.primary:hover {\n    background: var(--ai-primary-hover);\n  }\n";
	class a extends HTMLElement {
		constructor() {
			super(),
				this.attachShadow({ mode: "open" }),
				(this.responses = []),
				(this.markdownHandler = null);
		}
		static get observedAttributes() {
			return ["language"];
		}
		get language() {
			const e = this.getAttribute("language");
			return console.log("[ResponseHistory] Getting language:", e), e || "en";
		}
		connectedCallback() {
			console.log("[ResponseHistory] Connected, language:", this.language),
				console.log(
					"[ResponseHistory] Has language attribute:",
					this.hasAttribute("language")
				),
				console.log(
					"[ResponseHistory] All attributes:",
					this.getAttributeNames()
				),
				(this.translations = e[this.language] || e.en),
				console.log(
					"[ResponseHistory] Initial translations:",
					this.translations
				),
				this.render(),
				this.setupEventListeners();
		}
		attributeChangedCallback(n, t, o) {
			console.log(
				"[ResponseHistory] Attribute changed:",
				n,
				"from",
				t,
				"to",
				o
			),
				"language" === n &&
					t !== o &&
					(console.log(
						"[ResponseHistory] Updating translations for new language:",
						o
					),
					(this.translations = e[o] || e.en),
					console.log("[ResponseHistory] New translations:", this.translations),
					this.render());
		}
		createResponseEntry(e) {
			var t, o, r, a, i, s, l, d, c;
			const p = document.createElement("div");
			(p.className = "response-entry"),
				(p.dataset.id = e.id),
				(p.dataset.action = e.action);
			const h = ["info", "error", "chat-error"].includes(e.action),
				m = "chat-question" === e.action;
			if (h)
				return (
					(p.innerHTML = `\n      <div class="response-content-wrapper">\n        <div class="response-content">\n          ${
						this.markdownHandler
							? this.markdownHandler.convert(e.content)
							: e.content
					}\n        </div>\n      </div>\n    `),
					p
				);
			if (m) {
				const t = void 0 !== e.image && null !== e.image;
				return (
					(p.innerHTML = t
						? `\n        <div class="response-content-wrapper">\n          <div class="response-header mini">\n            <div class="response-tool">\n              ${n(
								e.action
						  )}\n              <span>Pregunta:</span>\n            </div>\n            <div class="response-timestamp">${this.formatTimestamp(
								e.timestamp
						  )}</div>\n          </div>\n          <div class="question-container">\n            <div class="question-content">\n              ${e.content.replace(
								/^\*\*Pregunta:\*\*\s*/i,
								""
						  )}\n            </div>\n            <div class="question-image mini">\n              <img src="${URL.createObjectURL(
								e.image
						  )}" alt="Imagen adjunta">\n            </div>\n          </div>\n          <div class="response-footer mini">\n            <button class="response-action edit-button mini" data-response-id="${
								e.id
						  }">\n              <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none">\n                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>\n                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>\n              </svg>\n            </button>\n          </div>\n        </div>\n      `
						: `\n        <div class="response-content-wrapper">\n          <div class="response-header mini">\n            <div class="response-tool">\n              ${n(
								e.action
						  )}\n              <span>Pregunta:</span>\n            </div>\n            <div class="response-timestamp">${this.formatTimestamp(
								e.timestamp
						  )}</div>\n          </div>\n          <div class="response-content">\n            ${e.content.replace(
								/^\*\*Pregunta:\*\*\s*/i,
								""
						  )}\n          </div>\n          <div class="response-footer mini">\n            <button class="response-action edit-button mini" data-response-id="${
								e.id
						  }">\n              <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none">\n                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>\n                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>\n              </svg>\n            </button>\n          </div>\n        </div>\n      `),
					p
				);
			}
			const u = document.createElement("div");
			u.className = "response-content-wrapper";
			const g = "" === e.content || e.content.length < 5,
				v = g ? "response-content typing-animation" : "response-content";
			let f;
			f =
				"image-upload" === e.action
					? e.content
					: g
					? "chat-response" === e.action
						? '<div class="typing-indicator">Escribiendo respuesta...</div>'
						: [
								"improve",
								"summarize",
								"expand",
								"paraphrase",
								"more-formal",
								"more-casual",
						  ].includes(e.action)
						? '<div class="typing-indicator">Pensando...</div>'
						: ""
					: this.markdownHandler
					? this.markdownHandler.convert(e.content)
					: e.content;
			const y = ["error", "info", "chat-error"].includes(e.action);
			let b = "";
			m ||
				y ||
				(b = `\n        <button class="tool-button" data-action="improve" data-response-id="${
					e.id
				}">\n          ${n("improve")}\n          ${
					(null == (o = null == (t = this.translations) ? void 0 : t.tools)
						? void 0
						: o.improve) || "Improve"
				}\n        </button>\n        <button class="tool-button" data-action="summarize" data-response-id="${
					e.id
				}">\n          ${n("summarize")}\n          ${
					(null == (a = null == (r = this.translations) ? void 0 : r.tools)
						? void 0
						: a.summarize) || "Summarize"
				}\n        </button>\n        <button class="tool-button" data-action="expand" data-response-id="${
					e.id
				}">\n          ${n("expand")}\n          ${
					(null == (s = null == (i = this.translations) ? void 0 : i.tools)
						? void 0
						: s.expand) || "Expand"
				}\n        </button>\n        <button class="tool-button" data-action="paraphrase" data-response-id="${
					e.id
				}">\n          ${n("paraphrase")}\n          ${
					(null == (d = null == (l = this.translations) ? void 0 : l.tools)
						? void 0
						: d.paraphrase) || "Paraphrase"
				}\n        </button>\n      `);
			const w =
				y || m
					? ""
					: `\n    <div class="response-footer">\n      <div class="response-tools">\n        ${b}\n      </div>\n      <div class="response-actions">\n        <button class="response-action copy-button" data-response-id="${e.id}">\n          <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none">\n            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>\n            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>\n          </svg>\n        </button>\n        <button class="response-action use-button" data-response-id="${e.id}">\n          <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none">\n            <polyline points="20 6 9 17 4 12"/>\n          </svg>\n        </button>\n        <button class="response-action retry-button" data-response-id="${e.id}" data-action="${e.action}">\n          <svg viewBox="0 0 24 24" width="16" height="16" stroke="currentColor" stroke-width="2" fill="none">\n            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0 1 18.8-4.3M22 12.5a10 10 0 0 1-18.8 4.3"/>\n          </svg>\n        </button>\n      </div>\n    </div>\n  `;
			if (
				((u.innerHTML = `\n    <div class="response-header">\n      <div class="response-tool">\n        ${n(
					e.action
				)}\n        <span>${
					(null == (c = this.translations) ? void 0 : c.tools[e.action]) ||
					e.action
				}</span>\n      </div>\n      <div class="response-timestamp">${this.formatTimestamp(
					e.timestamp
				)}</div>\n    </div>\n    <div class="${v}">\n      ${f}\n    </div>\n    ${w}\n  `),
				!this.shadowRoot.querySelector("#mini-elements-style"))
			) {
				const e = document.createElement("style");
				(e.id = "mini-elements-style"),
					(e.textContent =
						'\n      /* Estilos para elementos miniatura */\n      .mini {\n        margin: 0 !important;\n        padding: 0 !important;\n      }\n      \n      .response-header.mini {\n        margin-bottom: 0.25rem !important;\n      }\n      \n      .response-footer.mini {\n        padding-top: 0.25rem !important;\n        display: flex;\n        justify-content: flex-end;\n      }\n      \n      .question-image.mini {\n        width: 60px !important;\n        height: 60px !important;\n      }\n      \n      .question-image.mini img {\n        width: 60px !important;\n        height: 60px !important;\n      }\n      \n      .response-action.mini {\n        padding: 0.25rem !important;\n      }\n      \n      /* Estilos específicos para mensajes de información */\n      .response-entry[data-action="info"],\n      .response-entry[data-action="error"],\n      .response-entry[data-action="chat-error"] {\n        padding: 0.5rem 0.75rem !important;\n      }\n      \n      /* Estilos específicos para preguntas */\n      .response-entry[data-action="chat-question"] {\n        padding: 0.5rem 0.75rem !important;\n      }\n      \n      .question-container {\n        display: flex;\n        gap: 0.5rem;\n        align-items: flex-start;\n        margin: 0;\n        padding: 0;\n      }\n    '),
					this.shadowRoot.appendChild(e);
			}
			return p.appendChild(u), p;
		}
		setupEventListeners() {
			this.shadowRoot.addEventListener("click", (e) => {
				const n = e.target.closest("button");
				if (!n) return;
				const t = n.dataset.responseId;
				if (!t) return;
				const o = this.getResponse(t);
				if (o)
					if (n.classList.contains("tool-button")) {
						const e = n.dataset.action;
						console.log("[ResponseHistory] Tool button clicked:", {
							action: e,
							responseId: t,
						}),
							this.dispatchEvent(
								new CustomEvent("toolaction", {
									detail: { action: e, responseId: t, content: o.content },
									bubbles: !0,
									composed: !0,
								})
							);
					} else if (n.classList.contains("retry-button")) {
						const e = n.dataset.action;
						this.dispatchEvent(
							new CustomEvent("responseRetry", {
								detail: { responseId: t, action: e },
								bubbles: !0,
								composed: !0,
							})
						);
					} else if (n.classList.contains("edit-button"))
						this.dispatchEvent(
							new CustomEvent("responseEdit", {
								detail: { responseId: t },
								bubbles: !0,
								composed: !0,
							})
						);
					else if (n.classList.contains("copy-button"))
						this.dispatchEvent(
							new CustomEvent("responseCopy", {
								detail: { responseId: t },
								bubbles: !0,
								composed: !0,
							})
						);
					else if (n.classList.contains("use-button"))
						console.log("[ResponseHistory] Use button clicked"),
							this.dispatchEvent(
								new CustomEvent("responseUse", {
									detail: { responseId: t },
									bubbles: !0,
									composed: !0,
								})
							),
							setTimeout(() => {
								var e;
								console.log("[ResponseHistory] Attempting to close modal");
								try {
									let n = this;
									for (; n; ) {
										if (
											(console.log(
												"[ResponseHistory] Checking element for modal class:",
												n
											),
											null == (e = n.classList) ? void 0 : e.contains("modal"))
										) {
											console.log("[ResponseHistory] Found modal element:", n),
												n.classList.remove("open");
											break;
										}
										n = n.parentNode || n.getRootNode().host;
									}
								} catch (n) {
									console.error("[ResponseHistory] Error closing modal:", n);
								}
							}, 100);
					else if (n.classList.contains("retry-button")) {
						const e = n.dataset.action;
						this.dispatchEvent(
							new CustomEvent("responseRetry", {
								detail: { responseId: t, action: e },
								bubbles: !0,
								composed: !0,
							})
						);
					}
			});
		}
		getResponse(e) {
			console.log("[ResponseHistory] Getting response for ID:", e),
				console.log("[ResponseHistory] Available responses:", this.responses);
			const n = this.responses.find((n) => n.id === parseInt(e));
			return console.log("[ResponseHistory] Found response:", n), n;
		}
		addResponse(e) {
			console.log("[ResponseHistory] Adding response:", e),
				this.responses.push(e),
				this.render();
		}
		updateResponse(e, n) {
			var t;
			const o = this.responses.findIndex((n) => n.id === e);
			if (-1 === o) return;
			const r = this.responses[o],
				a = r.content;
			r.content = "function" == typeof n ? n(r.content) : n;
			const i = "" === a,
				s =
					"function" == typeof n &&
					r.content.length > a.length &&
					r.content.startsWith(a),
				l = this.shadowRoot.querySelector(`[data-id="${e}"]`);
			if (!l) return void this.render();
			const d = l.querySelector(".response-content");
			if (d)
				if (i) {
					console.log(
						"[ResponseHistory] Primera actualización, configurando streaming"
					);
					const e = document.createTextNode("");
					(d.innerHTML = ""),
						d.appendChild(e),
						(d.dataset.streamingActive = "true"),
						d.classList.add("typing-animation");
				} else if (s && "true" === d.dataset.streamingActive) {
					const e = r.content.substring(a.length);
					if (d.lastChild && d.lastChild.nodeType === Node.TEXT_NODE)
						d.lastChild.nodeValue += e;
					else {
						const e = document.createTextNode(r.content);
						(d.innerHTML = ""), d.appendChild(e);
					}
				} else {
					console.log(
						"[ResponseHistory] Streaming completo o actualización no incremental"
					);
					if (r.content.length > 50 && "true" === d.dataset.streamingActive) {
						d.classList.remove("typing-animation"),
							(d.dataset.streamingActive = "false");
						const e = r.content,
							n = (null == (t = l.parentNode) ? void 0 : t.scrollTop) || 0;
						if (this.markdownHandler)
							try {
								d.innerHTML = this.markdownHandler.convert(e);
							} catch (c) {
								console.error("[ResponseHistory] Error applying markdown:", c),
									(d.textContent = e);
							}
						else d.textContent = e;
						l.parentNode && (l.parentNode.scrollTop = n);
					} else
						s ||
							(this.markdownHandler
								? (d.innerHTML = this.markdownHandler.convert(r.content))
								: (d.textContent = r.content));
				}
		}
		getTypingPlaceholder() {
			return '<span class="typing">|</span>';
		}
		getResponse(e) {
			return this.responses.find((n) => n.id === parseInt(e));
		}
		removeResponse(e) {
			(this.responses = this.responses.filter((n) => n.id !== e)),
				this.render();
		}
		clear() {
			(this.responses = []), this.render();
		}
		render() {
			const e = document.createElement("style");
			e.textContent = `\n      ${t}\n      ${o}\n      ${r}\n      \n  /* ===== CONTENEDORES PRINCIPALES ===== */\n  .response-container {\n    overflow-y: auto;\n    max-height: 100%;\n  }\n\n  .response-entry {\n    background: var(--ai-surface);\n    border-radius: var(--ai-radius);\n    border: 1px solid var(--ai-border);\n    margin-bottom: 1rem;\n    padding: 1rem;\n    /* Optimizaciones de rendimiento */\n    contain: content;\n    position: relative;\n    will-change: contents;\n    transform: translateZ(0);\n    backface-visibility: hidden;\n  }\n\n  .response-content-wrapper {\n    flex: 1;\n    min-width: 0;\n    /* Optimizar para cambios frecuentes */\n    will-change: contents;\n  }\n\n  .response-entry[data-action="error"],\n  .response-entry[data-action="info"],\n  .response-entry[data-action="chat-error"] {\n    background: var(--ai-surface-light);\n    border-left: 3px solid var(--ai-error);\n    padding-left: calc(1rem - 3px);\n  }\n\n  .response-entry[data-action="info"] {\n    border-left-color: var(--ai-info);\n  }\n\n  /* ===== ÁREA DE CONTENIDO ===== */\n  .response-content {\n    margin: 1rem 0;\n    line-height: 1.5;\n    word-break: break-word;\n    overflow-wrap: break-word;\n    position: relative;\n    min-height: 1.5em;\n  }\n\n  /* Control para streaming activo */\n  .response-content[data-streaming-active="true"] {\n    transition: none !important;\n    user-select: none;\n  }\n\n  /* Desactivar transiciones durante streaming para contenido anidado */\n  .response-content[data-streaming-active="true"] * {\n    transition: none !important;\n  }\n\n  /* Restaurar selección cuando termina el streaming */\n  .response-content:not([data-streaming-active="true"]) {\n    user-select: text;\n  }\n\n  /* Contenido para markdown */\n  .response-content p {\n    margin: 0.5em 0;\n    animation: textReveal 0.2s ease-out forwards;\n  }\n\n  .response-content ul, \n  .response-content ol {\n    margin: 0.5em 0;\n    padding-left: 1.5em;\n  }\n\n  .response-content pre {\n    background: var(--ai-surface-dark);\n    padding: 1rem;\n    border-radius: var(--ai-radius);\n    overflow-x: auto;\n    margin-bottom: 1em;\n  }\n\n  .response-content code {\n    font-family: var(--ai-font-mono);\n    font-size: 0.9em;\n    padding: 0.2em 0.4em;\n    background: var(--ai-surface-dark);\n    border-radius: var(--ai-radius-sm);\n  }\n\n  /* Mantener contenido estable */\n  .response-content p, \n  .response-content ul, \n  .response-content ol,\n  .response-content pre {\n    contain: layout;\n  }\n\n  /* Eliminar margen en el último elemento para mantener espaciado consistente */\n  .response-content > *:last-child {\n    margin-bottom: 0;\n  }\n\n  /* ===== ANIMACIÓN DE ESCRITURA ===== */\n  /* Deshabilitar el cursor por defecto */\n  .response-content::after {\n    content: none;\n  }\n\n  /* Cursor de escritura personalizado */\n  .typing-animation::after {\n    content: '|';\n    display: inline-block;\n    width: 0.5em;\n    height: 1.2em;\n    background: transparent;\n    margin-left: 1px;\n    border: none;\n    animation: typingCursor 0.8s infinite step-end;\n    vertical-align: middle;\n    position: relative;\n    opacity: 0.8;\n  }\n\n  /* Eliminar CUALQUIER cursor adicional */\n  .typing-animation span.typing,\n  .typing span.cursor,\n  span.typing-cursor {\n    display: none !important;\n    opacity: 0 !important;\n    visibility: hidden !important;\n  }\n\n  /* Animación del cursor */\n  @keyframes typingCursor {\n    0%, 100% { opacity: 0.8; }\n    50% { opacity: 0; }\n  }\n\n  /* Indicadores de carga */\n  .typing-indicator {\n    color: var(--ai-text-light);\n    font-style: italic;\n    padding: 0.25rem 0;\n    animation: fadeInOut 1.5s ease-in-out infinite;\n  }\n\n  /* Animación para indicadores de carga */\n  @keyframes fadeInOut {\n    0%, 100% { opacity: 0.7; }\n    50% { opacity: 1; }\n  }\n\n  /* Efecto de texto apareciendo gradualmente */\n  @keyframes textReveal {\n    from { opacity: 0; transform: translateY(5px); }\n    to { opacity: 1; transform: translateY(0); }\n  }\n\n  /* Mensajes de estado iniciales para contenido vacío */\n  .response-entry[data-action="chat-response"] .response-content:empty::after,\n  .response-entry[data-action="summarize"] .response-content:empty::after,\n  .response-entry[data-action="improve"] .response-content:empty::after,\n  .response-entry[data-action="expand"] .response-content:empty::after,\n  .response-entry[data-action="paraphrase"] .response-content:empty::after,\n  .response-entry[data-action="more-formal"] .response-content:empty::after,\n  .response-entry[data-action="more-casual"] .response-content:empty::after {\n    content: 'Pensando...';\n    color: var(--ai-text-light);\n    font-style: italic;\n  }\n\n  .response-entry[data-action="chat-response"] .response-content:empty::after {\n    content: 'Escribiendo respuesta...';\n  }\n\n  /* ===== CABECERA Y PIE DE RESPUESTA ===== */\n  .response-header {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    margin-bottom: 0.5rem;\n    color: var(--ai-text-secondary);\n  }\n\n  .response-footer {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    padding: 1rem 0 0;\n    gap: 1rem;\n    border-top: 1px solid var(--ai-border);\n  }\n\n  /* ===== BOTONES Y ACCIONES ===== */\n  .response-actions {\n    display: flex;\n    gap: 0.5rem;\n  }\n\n  .response-tools {\n    display: flex;\n    gap: 0.5rem;\n    flex-wrap: nowrap;\n    overflow-x: auto;\n    padding: 0 0.25rem;\n  }\n\n  .response-tools::-webkit-scrollbar {\n    height: 4px;\n  }\n\n  .response-tools::-webkit-scrollbar-track {\n    background: var(--ai-surface-light);\n    border-radius: 2px;\n  }\n\n  .response-tools::-webkit-scrollbar-thumb {\n    background: var(--ai-surface-dark);\n    border-radius: 2px;\n  }\n\n  .response-action,\n  .tool-button {\n    display: inline-flex;\n    align-items: center;\n    gap: 0.5rem;\n    padding: 0.5rem 1rem;\n    border: none;\n    border-radius: var(--ai-radius);\n    background: var(--ai-surface-dark);\n    color: var(--ai-text);\n    cursor: pointer;\n    font-size: 0.875rem;\n    transition: all 0.2s ease;\n    white-space: nowrap;\n  }\n\n  .response-action {\n    padding: 0.5rem;\n  }\n\n  .response-action:hover,\n  .tool-button:hover {\n    background: var(--ai-primary);\n    color: white;\n  }\n\n  .response-action svg,\n  .tool-button svg {\n    width: 16px;\n    height: 16px;\n  }\n\n  /* ===== IMÁGENES Y ADJUNTOS ===== */\n  .response-entry.with-image {\n    display: grid;\n    grid-template-columns: auto 1fr;\n    gap: 1rem;\n    align-items: start;\n  }\n\n  .response-image-container {\n    width: 120px;\n  }\n\n  .image-preview {\n    width: 120px;\n    height: 120px;\n    border-radius: var(--ai-radius);\n    overflow: hidden;\n  }\n\n  .image-preview img {\n    width: 100%;\n    height: 100%;\n    object-fit: cover;\n  }\n\n  .response-content-with-image {\n    display: flex;\n    align-items: flex-start;\n    gap: 1rem;\n    margin: 1rem 0;\n  }\n\n  .response-image {\n    width: 100%;\n    height: 120px;\n    object-fit: cover;\n    border-radius: var(--ai-radius);\n    border: 1px solid var(--ai-border);\n  }\n\n  .response-image img {\n    width: 100%;\n    height: auto;\n    display: block;\n    object-fit: contain;\n  }\n\n  .image-filename {\n    font-size: 0.75rem;\n    color: var(--ai-text-light);\n    margin-top: 0.25rem;\n    text-align: center;\n    overflow: hidden;\n    text-overflow: ellipsis;\n    white-space: nowrap;\n  }\n\n  /* Estilos para imágenes en las respuestas */\n  .response-entry img {\n    max-width: 100px;\n    max-height: 100px;\n    object-fit: contain;\n    border-radius: var(--ai-radius);\n    border: 1px solid var(--ai-border);\n  }\n\n  .response-content .image-preview-card {\n    flex-shrink: 0;\n    width: 100px;\n    margin: 0;\n  }\n\n  .response-content .image-preview-card img {\n    width: 100%;\n    height: 100px;\n    object-fit: cover;\n  }\n\n  .response-content .image-preview-filename {\n    font-size: 0.75rem;\n    color: var(--ai-text-light);\n    text-align: center;\n    margin-top: 0.25rem;\n    overflow: hidden;\n    text-overflow: ellipsis;\n    white-space: nowrap;\n  }\n\n  /* ===== PREGUNTAS CON IMÁGENES ===== */\n  .question-container {\n    display: flex;\n    gap: 1rem;\n    align-items: flex-start;\n  }\n\n  .question-content {\n    flex: 1;\n    min-width: 0;\n  }\n\n  .question-image {\n    flex-shrink: 0;\n    width: 100px;\n    display: flex;\n    flex-direction: column;\n    align-items: center;\n    gap: 0.25rem;\n  }\n\n  .question-image img {\n    width: 100px;\n    height: 100px;\n    object-fit: cover;\n    border-radius: var(--ai-radius);\n    border: 1px solid var(--ai-border);\n  }\n\n  .question-image .image-filename {\n    font-size: 0.75rem;\n    color: var(--ai-text-light);\n    max-width: 100px;\n    overflow: hidden;\n    text-overflow: ellipsis;\n    white-space: nowrap;\n    text-align: center;\n  }\n\n  .question-with-image {\n    display: flex;\n    gap: 1rem;\n    align-items: flex-start;\n    margin: 0.5rem 0;\n  }\n\n  /* ESTILO PARA MENSAJES DE INFORMACIÓN */\n.response-entry[data-action="info"],\n.response-entry[data-action="error"],\n.response-entry[data-action="chat-error"] {\n  background-color: var(--ai-surface-light, #f9fafb);\n  padding: 0.5rem 0.75rem !important; \n  display: flex !important;\n  align-items: center !important;\n  max-height: none !important;\n}\n\n.response-entry[data-action="info"] .response-header,\n.response-entry[data-action="error"] .response-header,\n.response-entry[data-action="chat-error"] .response-header {\n  display: none !important; /* Ocultar header para más compacidad */\n}\n\n/* ESTILO PARA PREGUNTAS */\n.response-entry[data-action="chat-question"] {\n  padding: 0.5rem 0.75rem !important;\n  max-height: none !important;\n}\n\n      \n      /* Optimizaciones de layout */\n      .response-container {\n        overflow-y: auto;\n        max-height: 100%;\n        padding: 0;\n        margin: 0;\n        display: flex;\n        flex-direction: column;\n      }\n      \n      /* Reducir tamaño de los contenedores de respuesta */\n      .response-entry {\n        margin-bottom: 0.75rem !important;\n        padding: 0.75rem !important;\n        border-radius: var(--ai-radius);\n        max-height: fit-content;\n        overflow: visible;\n      }\n      \n      /* Reducir margen entre elementos */\n      .response-content {\n        margin: 0.25rem 0 !important;\n        line-height: 1.4 !important;\n        padding: 0 !important;\n      }\n      \n      /* Ajustar espaciado de cabecera */\n      .response-header {\n        margin-bottom: 0.25rem !important;\n      }\n      \n      /* Ajustar espaciado de pie */\n      .response-footer {\n        padding-top: 0.5rem !important;\n        margin-top: 0.25rem !important;\n      }\n      \n      /* Optimizar espaciado de párrafos */\n      .response-content p,\n      .response-content ul,\n      .response-content ol {\n        margin: 0.25em 0 !important;\n      }\n      \n      /* Reducir margen en listas */\n      .response-content ul, \n      .response-content ol {\n        padding-left: 1.25em !important;\n      }\n      \n      /* Optimizar tamaño de imágenes */\n      .question-image img {\n        width: 80px !important;\n        height: 80px !important;\n      }\n      \n      /* Ajustar espaciado de preguntas con imágenes */\n      .question-container {\n        gap: 0.5rem !important;\n      }\n      \n      /* Optimizar tamaño de botones */\n      .response-action {\n        padding: 0.35rem !important;\n      }\n      \n      .tool-button {\n        padding: 0.35rem 0.75rem !important;\n      }\n      \n      /* Optimizar indicadores de escritura */\n      .typing-indicator {\n        padding: 0.125rem 0 !important;\n      }\n    `;
			const n = document.createElement("div");
			for (
				n.className = "response-container",
					this.responses.forEach((e) => {
						n.appendChild(this.createResponseEntry(e));
					});
				this.shadowRoot.firstChild;

			)
				this.shadowRoot.removeChild(this.shadowRoot.firstChild);
			this.shadowRoot.appendChild(e),
				this.shadowRoot.appendChild(n),
				this.responses.length > 0 &&
					requestAnimationFrame(() => {
						n.scrollTop = n.scrollHeight;
					});
		}
		formatTimestamp(e) {
			if (!e) return "";
			try {
				return (
					console.log("[ResponseHistory] Formatting timestamp:", e),
					new Date(e).toLocaleTimeString(this.language || "en", {
						hour: "2-digit",
						minute: "2-digit",
					})
				);
			} catch (n) {
				return (
					console.error("[ResponseHistory] Error formatting timestamp:", n), ""
				);
			}
		}
	}
	customElements.define("response-history", a);
	class i extends HTMLElement {
		constructor() {
			super(), this.attachShadow({ mode: "open" }), (this.tempImage = null);
		}
		static get observedAttributes() {
			return ["language", "image-url", "api-provider"];
		}
		get language() {
			return this.getAttribute("language") || "en";
		}
		get translations() {
			return e[this.language] || e.en;
		}
		get imageUrl() {
			return this.getAttribute("image-url");
		}
		get apiProvider() {
			return this.getAttribute("api-provider") || "openai";
		}
		get supportsImages() {
			return ["openai", "anthropic"].includes(this.apiProvider);
		}
		async connectedCallback() {
			this.render(),
				this.setupEventListeners(),
				this.imageUrl && (await this.handleImageUrl(this.imageUrl));
		}
		attributeChangedCallback(e, n, t) {
			if (n !== t)
				switch (e) {
					case "language":
						this.updateTranslations();
						break;
					case "image-url":
						t && this.handleImageUrl(t);
						break;
					case "api-provider":
						this.updateUploadVisibility();
				}
		}
		updateImagePreview() {
			const e = this.shadowRoot.querySelector(".image-preview-container");
			e && e.remove();
		}
		render() {
			const e = document.createElement("style");
			e.textContent = `\n      ${t}\n      ${o}\n      \n\n  .chat-form {\n    display: flex;\n    gap: 0.5rem;\n  }\n\n  .chat-container {\n  border: 1px solid var(--ai-border);\n    border-radius: 8px;\n    background: white;\n  }\n\n  .chat-input {\n    flex: 1;\n    padding: 0.75rem;\n    border: 1px solid var(--ai-border);\n    border-radius: var(--ai-radius);\n    font-family: var(--ai-font-sans);\n    transition: border-color 0.2s ease;\n  }\n\n  .chat-input:focus {\n    outline: none;\n    border-color: var(--ai-primary);\n  }\n\n  .chat-submit {\n    display: inline-flex;\n    align-items: center;\n    gap: 0.5rem;\n    padding: 0.75rem 1rem;\n    background: var(--ai-primary);\n    color: white;\n    border: none;\n    border-radius: var(--ai-radius);\n    cursor: pointer;\n    transition: background-color 0.2s ease;\n  }\n\n  .chat-submit:hover {\n    background: var(--ai-primary-hover);\n  }\n\n      \n      .chat-form {\n        display: flex;\n        gap: 8px;\n        align-items: flex-start;\n        padding: 8px;\n      }\n      \n      .chat-input-container {\n        position: relative;\n        flex: 1;\n        display: flex;\n        align-items: flex-end;\n      }\n      \n      .chat-submit {\n        flex-shrink: 0;\n        width: 32px;\n        height: 32px;\n        padding: 0;\n        display: inline-flex;\n        align-items: center;\n        justify-content: center;\n      }\n      \n      .chat-input {\n        flex: 1;\n        min-height: 24px;\n        max-height: 150px;\n        padding: 12px;\n        padding-right: 40px;\n        background: var(--ai-background);\n        color: var(--ai-text);\n        font-size: 14px;\n        line-height: 1.5;\n        overflow-y: auto;\n        white-space: pre-wrap;\n        word-wrap: break-word;\n      }\n      \n      .chat-input:empty::before {\n        content: attr(data-placeholder);\n        color: var(--ai-text-light);\n      }\n      \n      .chat-input:focus {\n        outline: none;\n      }\n      \n      .chat-upload-button {\n        display: inline-flex;\n        cursor: pointer;\n        color: var(--ai-text-light);\n\n            width: 32px;\n    height: 32px;\n    background: lightgray;\n    padding: 0;\n    align-items: center;\n    justify-content: center;\n    border-radius: var(--ai-radius);\n    border: 0;\n    flex-shrink: 0;\n      }\n      \n      .chat-upload-button:hover {\n        color: var(--ai-text);\n      }\n      \n      .hidden {\n        display: none !important;\n      }\n    `;
			const n = `\n      <div class="chat-container">\n        <form class="chat-form">\n          <div class="chat-input-container">\n            <div class="chat-input" \n                 contenteditable="true" \n                 data-placeholder="${
				this.translations.chat.placeholder
			}"\n                 role="textbox"\n                 aria-multiline="true"></div>\n          </div>\n          ${
				this.supportsImages
					? '\n            <label class="chat-upload-button" title="Upload image">\n              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7"/>\n                <circle cx="9" cy="9" r="2"/>\n                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>\n              </svg>\n              <input type="file" accept="image/*" class="hidden" id="imageInput">\n            </label>\n          '
					: ""
			}\n          <button type="submit" class="chat-submit">\n            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n              <path d="M5 12h14"/>\n              <path d="m12 5 7 7-7 7"/>\n            </svg>\n          </button>\n        </form>\n      </div>\n    `;
			(this.shadowRoot.innerHTML = ""),
				this.shadowRoot.appendChild(e),
				this.shadowRoot.appendChild(
					document.createRange().createContextualFragment(n)
				);
		}
		setupEventListeners() {
			const e = this.shadowRoot.querySelector(".chat-form"),
				n = this.shadowRoot.querySelector(".chat-input"),
				t = this.shadowRoot.querySelector(".chat-upload-button"),
				o = this.shadowRoot.querySelector("#imageInput");
			e.addEventListener("submit", this.handleSubmit.bind(this)),
				n.addEventListener("keydown", (n) => {
					"Enter" !== n.key ||
						n.shiftKey ||
						(n.preventDefault(), e.dispatchEvent(new Event("submit")));
				}),
				t &&
					o &&
					(t.addEventListener("click", (e) => {
						e.stopPropagation();
					}),
					o.addEventListener("change", (e) => {
						this.handleFileSelect(e), (e.target.value = "");
					}));
		}
		handleFileSelect(e) {
			const n = e.target.files[0];
			n && (this.tempImage = n);
		}
		handleSubmit(e) {
			e.preventDefault(), e.stopPropagation();
			const n = this.shadowRoot.querySelector(".chat-input"),
				t = n.innerText.trim();
			(t || this.tempImage) &&
				(this.dispatchEvent(
					new CustomEvent("chatMessage", {
						detail: { message: t, image: this.tempImage },
						bubbles: !0,
						composed: !0,
					})
				),
				(n.innerText = ""),
				(this.tempImage = null));
		}
		updateTranslations() {
			const e = this.shadowRoot.querySelector(".chat-input"),
				n = this.shadowRoot.querySelector(".chat-submit");
			e &&
				n &&
				(e.setAttribute("data-placeholder", this.translations.chat.placeholder),
				(n.innerHTML =
					'\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n          <path d="M5 12h14"/>\n          <path d="m12 5 7 7-7 7"/>\n        </svg>\n      '));
		}
		updateUploadVisibility() {
			const e = this.shadowRoot.querySelector(".chat-upload-button");
			e && (e.style.display = this.supportsImages ? "inline-flex" : "none");
		}
		async handleImageUrl(e) {
			try {
				const n = await fetch(e),
					t = await n.blob(),
					o = new File([t], "image.jpg", { type: t.type });
				(this.tempImage = o), this.updateImagePreview();
			} catch (n) {
				console.error("Error loading image:", n);
			}
		}
	}
	customElements.define("chat-with-image", i);
	class s extends HTMLElement {
		constructor() {
			super(),
				this.attachShadow({ mode: "open" }),
				(this.currentAction = "improve");
		}
		static get observedAttributes() {
			return ["has-content", "language"];
		}
		get hasContent() {
			return "true" === this.getAttribute("has-content");
		}
		get language() {
			return this.getAttribute("language") || "en";
		}
		get translations() {
			return e[this.language] || e.en;
		}
		connectedCallback() {
			this.render(), this.bindEvents();
		}
		attributeChangedCallback(e, n, t) {
			n !== t &&
				("language" === e
					? this.render()
					: "has-content" === e && this.updateVisibleTools());
		}
		render() {
			const e = document.createElement("style");
			(e.textContent =
				"\n      :host {\n        display: block;\n      }\n\n      .tools {\n        display: flex;\n        gap: 8px;\n        margin-bottom: 16px;\n        flex-wrap: wrap;\n      }\n\n      .tool-button {\n        display: inline-flex;\n        align-items: center;\n        gap: 8px;\n        padding: 8px 16px;\n        border: none;\n        border-radius: 6px;\n        background: #e5e7eb;\n        cursor: pointer;\n        font-family: inherit;\n      }\n\n      .tool-button:hover {\n        background: #d1d5db;\n      }\n\n      .tool-button.active {\n        background: #3b82f6;\n        color: white;\n      }\n\n      .tool-button svg {\n        width: 16px;\n        height: 16px;\n      }\n    "),
				(this.shadowRoot.innerHTML = ""),
				this.shadowRoot.appendChild(e),
				this.shadowRoot.appendChild(this.createToolbar()),
				requestAnimationFrame(() => {
					this.updateVisibleTools();
				});
		}
		createToolbar() {
			const e = document.createElement("div");
			e.className = "tools";
			return (
				[
					{ action: "improve", label: this.translations.tools.improve },
					{ action: "summarize", label: this.translations.tools.summarize },
					{ action: "expand", label: this.translations.tools.expand },
					{ action: "paraphrase", label: this.translations.tools.paraphrase },
					{
						action: "more-formal",
						label:
							this.translations.tools["more-formal"] ||
							this.translations.tools.formal,
					},
					{
						action: "more-casual",
						label:
							this.translations.tools["more-casual"] ||
							this.translations.tools.casual,
					},
				].forEach((t) => {
					const o = document.createElement("button");
					(o.className = "tool-button"), (o.dataset.action = t.action);
					const r = t.label || t.action;
					(o.innerHTML = `${n(t.action)}${r}`), e.appendChild(o);
				}),
				e
			);
		}
		bindEvents() {
			this.shadowRoot.querySelectorAll(".tool-button").forEach((e) => {
				e.onclick = () => {
					this.setActiveAction(e.dataset.action),
						this.dispatchEvent(
							new CustomEvent("toolaction", {
								detail: { action: e.dataset.action },
								bubbles: !0,
								composed: !0,
							})
						);
				};
			});
		}
		setActiveAction(e) {
			(this.currentAction = e),
				this.shadowRoot.querySelectorAll(".tool-button").forEach((n) => {
					n.classList.toggle("active", n.dataset.action === e);
				});
		}
		updateVisibleTools() {
			const e = this.hasContent,
				t = this.shadowRoot.querySelector('[data-action="improve"]'),
				o = this.shadowRoot.querySelectorAll(".tool-button");
			(t.innerHTML = e
				? `${n("improve")}${this.translations.tools.improve}`
				: `\n        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">\n          <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/>\n          <path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/>\n        </svg>\n        ${
						this.translations.tools.generate || "Generate"
				  }\n      `),
				o.forEach((n) => {
					const t = n.dataset.action;
					n.style.display = e || "improve" === t ? "inline-flex" : "none";
				});
		}
		getCurrentAction() {
			return this.currentAction;
		}
	}
	customElements.define("ai-toolbar", s);
	const l = {
		openai: {
			models: {
				"gpt-4-turbo": {
					name: "GPT-4 Turbo",
					contextWindow: 128e3,
					description: "Latest GPT-4 model with larger context window",
					suggested: !0,
					maxTokens: 4096,
					costPer1k: 0.01,
					supportsImages: !0,
				},
				"gpt-4": {
					name: "GPT-4",
					contextWindow: 8192,
					description: "Most capable GPT-4 model",
					maxTokens: 4096,
					costPer1k: 0.03,
					supportsImages: !0,
				},
				"gpt-3.5-turbo": {
					name: "GPT-3.5 Turbo",
					contextWindow: 16385,
					description: "Efficient and cost-effective model",
					maxTokens: 4096,
					costPer1k: 0.0015,
					supportsImages: !1,
				},
			},
			defaultModel: "gpt-4-turbo",
			visionModel: "gpt-4-turbo",
		},
		anthropic: {
			models: {
				"claude-3-opus-20240229": {
					name: "Claude 3 Opus",
					contextWindow: 2e5,
					description: "Most capable Claude model",
					suggested: !0,
					supportsImages: !0,
				},
				"claude-3-sonnet-20240229": {
					name: "Claude 3 Sonnet",
					contextWindow: 2e5,
					description: "Balance of intelligence and speed",
					supportsImages: !0,
				},
			},
			defaultModel: "claude-3-opus-20240229",
			visionModel: "claude-3-opus-20240229",
		},
		deepseek: {
			models: {
				"deepseek-chat": {
					name: "DeepSeek Chat",
					contextWindow: 32768,
					description: "General purpose chat model",
					suggested: !0,
					maxTokens: 4096,
				},
				"deepseek-coder": {
					name: "DeepSeek Coder",
					contextWindow: 32768,
					description: "Specialized in code generation",
					maxTokens: 4096,
				},
			},
			defaultModel: "deepseek-chat",
		},
		cohere: {
			models: {
				command: {
					name: "Command",
					contextWindow: 4096,
					description: "Latest generation model",
					suggested: !0,
					maxTokens: 4096,
				},
				"command-light": {
					name: "Command Light",
					contextWindow: 4096,
					description: "Faster, more efficient model",
					maxTokens: 4096,
				},
				"command-nightly": {
					name: "Command Nightly",
					contextWindow: 4096,
					description: "Experimental features",
					maxTokens: 4096,
				},
			},
			defaultModel: "command",
		},
		google: {
			models: {
				"gemini-pro": {
					name: "Gemini Pro",
					contextWindow: 32768,
					description: "Most capable Gemini model",
					suggested: !0,
					maxTokens: 4096,
					supportsImages: !1,
				},
				"gemini-pro-vision": {
					name: "Gemini Pro Vision",
					contextWindow: 32768,
					description: "Multimodal capabilities",
					maxTokens: 4096,
					supportsImages: !0,
				},
			},
			defaultModel: "gemini-pro",
			visionModel: "gemini-pro-vision",
		},
		mistral: {
			models: {
				"mistral-large-latest": {
					name: "Mistral Large",
					contextWindow: 32768,
					description: "Most capable Mistral model",
					suggested: !0,
					maxTokens: 4096,
				},
				"mistral-medium-latest": {
					name: "Mistral Medium",
					contextWindow: 32768,
					description: "Balanced performance",
					maxTokens: 4096,
				},
				"mistral-small-latest": {
					name: "Mistral Small",
					contextWindow: 32768,
					description: "Fast and efficient",
					maxTokens: 4096,
				},
			},
			defaultModel: "mistral-large-latest",
		},
		ollama: {
			models: {
				llama2: {
					name: "Llama 2",
					contextWindow: 4096,
					description: "Default Llama 2 model",
					suggested: !0,
					maxTokens: 4096,
				},
				"llama2:13b": {
					name: "Llama 2 13B",
					contextWindow: 4096,
					description: "Balanced 13B parameter model",
					maxTokens: 4096,
				},
				"llama2:70b": {
					name: "Llama 2 70B",
					contextWindow: 4096,
					description: "Large 70B parameter model",
					maxTokens: 4096,
				},
				mistral: {
					name: "Mistral",
					contextWindow: 8192,
					description: "Mistral base model",
					maxTokens: 4096,
				},
				mixtral: {
					name: "Mixtral",
					contextWindow: 32768,
					description: "Mixtral 8x7B model",
					maxTokens: 4096,
				},
			},
			defaultModel: "llama2",
		},
	};
	class d {
		constructor(e = "openai") {
			(this.provider = e), (this.config = l);
		}
		getModelConfig(e) {
			const n = this.config[this.provider];
			if (!n) throw new Error(`Provider ${this.provider} not supported`);
			return e && n.models[e] ? n.models[e] : n.models[n.default];
		}
		getDefaultModel() {
			const e = this.config[this.provider];
			if (!e) throw new Error(`Provider ${this.provider} not supported`);
			return e.default;
		}
		getAllModels() {
			const e = this.config[this.provider];
			if (!e) throw new Error(`Provider ${this.provider} not supported`);
			return Object.values(e.models);
		}
		isProviderSupported(e) {
			return !!this.config[e];
		}
		isImageSupportedForProvider(e) {
			const n = this.config[e];
			return (
				!!n &&
				(!!n.visionModel || ["openai", "anthropic", "google"].includes(e))
			);
		}
		getVisionModelForProvider(e) {
			const n = this.config[e];
			return n ? (n.visionModel ? n.visionModel : n.defaultModel) : null;
		}
		setProvider(e) {
			if (!this.isProviderSupported(e))
				throw new Error(`Provider ${e} not supported`);
			this.provider = e;
		}
	}
	class c {
		constructor() {
			(this.modelManager = new d()),
				(this.tokensPerChar = {
					en: 0.25,
					es: 0.28,
					fr: 0.28,
					de: 0.3,
					zh: 0.5,
					ja: 0.5,
				}),
				(this.defaultTokensPerChar = 0.25);
		}
	}
	class p {
		constructor() {
			this.marked = null;
		}
		async initialize() {
			try {
				const { marked: e } = await import(
					"https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js"
				);
				(this.marked = e),
					this.marked.setOptions({ gfm: !0, breaks: !0, sanitize: !1 });
			} catch (e) {
				throw (console.error("Error initializing markdown handler:", e), e);
			}
		}
		convert(e) {
			return e && this.marked ? this.marked(e) : e;
		}
	}
	class h {
		constructor(e = {}) {
			(this.modelManager = new d(e.provider || "openai")),
				(this.config = {
					provider: e.provider || "openai",
					proxyEndpoint:
						e.proxyEndpoint || "http://llmproxy.test:8080/api/llm-proxy",
					models: {
						openai: e.model || "gpt-4-turbo",
						deepseek: "deepseek-chat",
						anthropic: "claude-3-opus-20240229",
						cohere: "command",
						google: "gemini-pro",
						mistral: "mistral-large-latest",
					},
					visionModels: {
						openai: "gpt-4-turbo",
						anthropic: "claude-3-opus-20240229",
					},
					temperature: e.temperature || 0.7,
					sessionToken: e.sessionToken || "",
					systemPrompt:
						e.systemPrompt ||
						"Actúa como un experto en redacción de descripciones de productos para tiendas en línea.\n\nTu tarea es generar o mejorar la descripción de un producto con un enfoque atractivo y persuasivo, destacando sus características principales, beneficios y posibles usos.\n\nSi el usuario ya ha escrito una descripción: Mejórala manteniendo su esencia, pero haciéndola más clara, persuasiva y optimizada para ventas.\n\nSi la descripción está vacía: Genera una nueva descripción atractiva, destacando características y beneficios. Usa un tono profesional y cercano, adaptado a una tienda en línea.\n\nSi hay una imagen del producto, aprovecha los detalles visuales para enriquecer la descripción.\n\nSi aplica, menciona información relevante del comercio para reforzar la confianza del comprador (envíos, garantía, atención al cliente, etc.).\n\nMantén el texto claro, sin repeticiones innecesarias, y optimizado para SEO si es posible.",
					tenantId: e.tenantId || "",
					userId: e.userId || "",
				});
		}
		setSessionToken(e) {
			this.config.sessionToken = e;
		}
		setProvider(e) {
			if (!this.modelManager.isProviderSupported(e))
				throw new Error(`Provider ${e} not supported`);
			(this.config.provider = e),
				this.modelManager.setProvider(e),
				(this.config.models[e] = this.modelManager.getDefaultModel());
		}
		setModel(e) {
			e && (this.config.models[this.config.provider] = e);
		}
		updateConfig(e) {
			e.provider && this.setProvider(e.provider),
				e.model && this.setModel(e.model),
				e.sessionToken && this.setSessionToken(e.sessionToken),
				e.tenantId && (this.config.tenantId = e.tenantId),
				e.userId && (this.config.userId = e.userId),
				e.proxyEndpoint && (this.config.proxyEndpoint = e.proxyEndpoint);
		}
		async processStream(e, n) {
			const t = e.body.getReader(),
				o = new TextDecoder();
			let r = "",
				a = "";
			try {
				for (console.log("Iniciando procesamiento de stream"); ; ) {
					const { done: e, value: l } = await t.read();
					if (e) {
						console.log("Stream completado");
						break;
					}
					console.log("Fragmento raw recibido:", new TextDecoder().decode(l)),
						(r += o.decode(l, { stream: !0 })),
						console.log("Buffer acumulado:", r);
					const d = r.split("\n");
					r = d.pop() || "";
					for (const t of d)
						if ((console.log("Procesando línea:", t), t.startsWith("data: "))) {
							const e = t.slice(5).trim();
							if ("[DONE]" === e) {
								console.log("Fin de stream detectado");
								continue;
							}
							if (!e) {
								console.log("Skipping empty chunk");
								continue;
							}
							try {
								const t = JSON.parse(e);
								if (
									(console.log("Chunk JSON parseado:", t),
									t.choices && t.choices[0].delta && t.choices[0].delta.content)
								) {
									const e = t.choices[0].delta.content;
									(a += e),
										console.log("Contenido nuevo añadido (OpenAI):", e),
										n(e);
								} else
									t.text
										? ((a += t.text),
										  console.log("Contenido nuevo añadido (text):", t.text),
										  n(t.text))
										: t.content
										? ((a += t.content),
										  console.log(
												"Contenido nuevo añadido (content):",
												t.content
										  ),
										  n(t.content))
										: t.delta &&
										  t.delta.text &&
										  ((a += t.delta.text),
										  console.log(
												"Contenido nuevo añadido (Anthropic):",
												t.delta.text
										  ),
										  n(t.delta.text));
							} catch (i) {
								if (
									(console.error("Error procesando chunk:", i, "Texto:", e),
									e.includes('"text":"') || e.includes('"content":"'))
								)
									try {
										const t = e.match(/"(text|content)":"([^"]*)"/);
										if (t && t[2]) {
											const e = t[2];
											(a += e),
												console.log(
													"Contenido extraído de texto malformado:",
													e
												),
												n(e);
										}
									} catch (s) {
										console.error(
											"Error extracting text from malformed JSON:",
											s
										);
									}
							}
						}
				}
				return a;
			} catch (l) {
				throw (console.error("Error en procesamiento de stream:", l), l);
			}
		}
		async makeRequest(e, n, t = () => {}) {
			var o;
			try {
				const r = this.config.models[this.config.provider];
				if (!r) throw new Error("Model not configured for provider");
				const a = {
					provider: this.config.provider,
					model: r,
					messages: [
						{ role: "system", content: this.config.systemPrompt },
						{
							role: "user",
							content: `${e}\n\n${n || "Crea una nueva descripción."}`,
						},
					],
					temperature: this.config.temperature,
					stream: !0,
					tenantId: this.config.tenantId,
					userId: this.config.userId,
				};
				console.log("Enviando solicitud al proxy:", this.config.proxyEndpoint),
					console.log("Payload:", a);
				const i = await fetch(this.config.proxyEndpoint, {
					method: "POST",
					headers: { "Content-Type": "application/json" },
					body: JSON.stringify(a),
				});
				if (
					(console.log("Respuesta del proxy:", {
						status: i.status,
						ok: i.ok,
						headers: Object.fromEntries([...i.headers.entries()]),
					}),
					!i.ok)
				) {
					const e = await i.json().catch(() => ({}));
					throw new Error(
						(null == (o = e.error) ? void 0 : o.message) ||
							`API Error: ${i.status} ${i.statusText}`
					);
				}
				return await this.processStream(i, t);
			} catch (r) {
				throw (
					(console.error("Error al hacer la solicitud:", r),
					new m(r.message, r))
				);
			}
		}
		async makeRequestWithImage(e, n, t, o = () => {}) {
			var r;
			try {
				let i,
					s,
					l = "image/jpeg";
				if ("string" == typeof t) s = t;
				else {
					if (!(t instanceof File)) throw new Error("Invalid image source");
					(i = await this.imageToBase64(t)),
						(l = t.type || l),
						console.log("Image file type:", l);
				}
				const d = [];
				"openai" === this.config.provider
					? (d.push({ role: "system", content: this.config.systemPrompt }),
					  d.push({
							role: "user",
							content: [
								{
									type: "text",
									text: `${e}\n\n${n || "Please create a new description."}`,
								},
								{
									type: "image_url",
									image_url: s
										? { url: s, detail: "high" }
										: { url: `data:${l};base64,${i}`, detail: "high" },
								},
							],
					  }))
					: "anthropic" === this.config.provider
					? d.push({
							role: "user",
							content: [
								{ type: "text", text: this.config.systemPrompt },
								{
									type: "image",
									source: s
										? { type: "url", url: s }
										: { type: "base64", media_type: l, data: i },
								},
								{
									type: "text",
									text: `${e}\n\n${n || "Please create a new description."}`,
								},
							],
					  })
					: "google" === this.config.provider &&
					  d.push({
							role: "user",
							parts: [
								{
									text: `${this.config.systemPrompt}\n\n${e}\n\n${
										n || "Please create a new description."
									}`,
								},
								{ inline_data: { mime_type: l, data: i } },
							],
					  });
				const c = this.modelManager.getVisionModelForProvider(
						this.config.provider
					),
					p = {
						provider: this.config.provider,
						model: c || this.config.models[this.config.provider],
						messages: d,
						temperature: this.config.temperature,
						stream: !0,
						tenantId: this.config.tenantId,
						userId: this.config.userId,
						hasImage: !0,
					};
				console.log("Sending image request to proxy:", {
					endpoint: this.config.proxyEndpoint,
					provider: this.config.provider,
					model: p.model,
					hasImage: !0,
					imageType: l,
				});
				const h = await fetch(this.config.proxyEndpoint, {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						...(this.config.sessionToken && {
							Authorization: `Bearer ${this.config.sessionToken}`,
						}),
					},
					body: JSON.stringify(p),
				});
				if (
					(console.log(
						"Image request response status:",
						h.status,
						h.statusText
					),
					!h.ok)
				)
					try {
						const e = await h.json();
						throw (
							(console.error("Image API Error Response:", e),
							new Error(
								(null == (r = e.error) ? void 0 : r.message) ||
									`API Error: ${h.status} ${h.statusText}`
							))
						);
					} catch (a) {
						console.error("Failed to parse error response:", a);
						const e = await h.text().catch(() => "");
						throw (
							(console.error("Raw error response:", e),
							new Error(`API Error: ${h.status} ${h.statusText}`))
						);
					}
				return await this.processStream(h, o);
			} catch (i) {
				throw (
					(console.error("Image processing error:", i),
					new Error(`Image processing failed: ${i.message}`))
				);
			}
		}
		async imageToBase64(e) {
			if (!e) throw new Error("No image file provided");
			if (!e.type.startsWith("image/"))
				throw new Error("Invalid file type. Please provide an image file.");
			return new Promise((n, t) => {
				const o = new FileReader();
				(o.onload = () => {
					try {
						const e = o.result.split(",")[1];
						if (!e)
							return void t(new Error("Failed to convert image to base64"));
						n(e);
					} catch (e) {
						t(new Error("Failed to process image data"));
					}
				}),
					(o.onerror = () => t(new Error("Failed to read image file"))),
					o.readAsDataURL(e);
			});
		}
		async enhanceText(e, n = "improve", t = null, o = "", r = () => {}) {
			const a = {
					improve: `Mejora esta descripción considerando estos detalles del producto:\n${o}\n\nDescripción actual:`,
					summarize: `Teniendo en cuenta estos detalles del producto:\n${o}\n\nCrea un resumen conciso y efectivo de la siguiente descripción:`,
					expand: `Basándote en estos detalles del producto:\n${o}\n\nExpande esta descripción añadiendo más detalles, beneficios y casos de uso:`,
					paraphrase: `Considerando estos detalles del producto:\n${o}\n\nReescribe esta descripción manteniendo el mensaje principal pero con un enfoque fresco:`,
					"more-formal": `Usando estos detalles del producto:\n${o}\n\nReescribe esta descripción con un tono más formal, profesional y técnico, manteniendo la información clave pero usando un lenguaje más sofisticado y corporativo:`,
					"more-casual": `Usando estos detalles del producto:\n${o}\n\nReescribe esta descripción con un tono más casual y cercano, como si estuvieras explicándolo a un amigo, manteniendo un lenguaje accesible y conversacional pero sin perder profesionalismo:`,
					empty: `Usando estos detalles del producto:\n${o}\n\nCrea una descripción profesional y atractiva que destaque sus características principales:`,
				},
				i = a[n] || a.improve;
			if (
				!t ||
				!this.modelManager.isImageSupportedForProvider(this.config.provider)
			)
				return await this.makeRequest(i, e, r);
			try {
				return await this.makeRequestWithImage(i, e, t, r);
			} catch (s) {
				return (
					console.warn(
						"Image analysis failed, falling back to text-only analysis:",
						s
					),
					await this.makeRequest(i, e, r)
				);
			}
		}
		async chatResponse(e, n, t = null, o = () => {}) {
			var r;
			try {
				let s = [
						{ role: "system", content: this.config.systemPrompt },
						{ role: "user", content: e },
					],
					l = !1;
				if (n)
					if (
						t &&
						this.modelManager.isImageSupportedForProvider(this.config.provider)
					)
						try {
							const e = await this.imageToBase64(t),
								o = t.type || "image/jpeg";
							console.log("Chat with image - file type:", o),
								(l = !0),
								"openai" === this.config.provider
									? s.push({
											role: "user",
											content: [
												{ type: "text", text: n },
												{
													type: "image_url",
													image_url: {
														url: `data:${o};base64,${e}`,
														detail: "auto",
													},
												},
											],
									  })
									: "anthropic" === this.config.provider
									? s.push({
											role: "user",
											content: [
												{ type: "text", text: n },
												{
													type: "image",
													source: { type: "base64", media_type: o, data: e },
												},
											],
									  })
									: "google" === this.config.provider
									? s.push({
											role: "user",
											parts: [
												{ text: n },
												{ inline_data: { mime_type: o, data: e } },
											],
									  })
									: (s.push({ role: "user", content: n }), (l = !1));
						} catch (a) {
							console.error("Failed to process image for chat:", a),
								s.push({ role: "user", content: n }),
								(l = !1);
						}
					else s.push({ role: "user", content: n });
				const d = l
						? this.modelManager.getVisionModelForProvider(this.config.provider)
						: this.config.models[this.config.provider],
					c = {
						provider: this.config.provider,
						model: d,
						messages: s,
						temperature: this.config.temperature,
						stream: !0,
						tenantId: this.config.tenantId,
						userId: this.config.userId,
						hasImage: l,
					};
				console.log("Sending chat request to proxy:", {
					endpoint: this.config.proxyEndpoint,
					provider: this.config.provider,
					model: c.model,
					hasImage: l,
				});
				const p = await fetch(this.config.proxyEndpoint, {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						...(this.config.sessionToken && {
							Authorization: `Bearer ${this.config.sessionToken}`,
						}),
					},
					body: JSON.stringify(c),
				});
				if (
					(console.log("Chat response status:", p.status, p.statusText), !p.ok)
				)
					try {
						const e = await p.json();
						throw (
							(console.error("Chat API Error Response:", e),
							new Error(
								(null == (r = e.error) ? void 0 : r.message) ||
									`API Error: ${p.status} ${p.statusText}`
							))
						);
					} catch (i) {
						console.error("Failed to parse error response:", i);
						const e = await p.text().catch(() => "");
						throw (
							(console.error("Raw error response:", e),
							new Error(`API Error: ${p.status} ${p.statusText}`))
						);
					}
				return await this.processStream(p, o);
			} catch (s) {
				throw (
					(console.error("Chat response error:", s),
					new m(`Chat response failed: ${s.message}`, s))
				);
			}
		}
		get supportsImages() {
			return this.modelManager.isImageSupportedForProvider(
				this.config.provider
			);
		}
	}
	class m extends Error {
		constructor(e, n = null) {
			super(e), (this.name = "APIError"), (this.originalError = n);
		}
	}
	class u {
		constructor(e = {}) {
			(this.options = {
				prefix: e.prefix || "ai-text-enhancer-cache",
				maxItems: e.maxItems || 20,
				ttl: e.ttl || 18e5,
				storage: e.storage || window.sessionStorage,
			}),
				this.validateStorage();
		}
		validateStorage() {
			try {
				const e = `${this.options.prefix}-test`;
				this.options.storage.setItem(e, "test"),
					this.options.storage.removeItem(e);
			} catch (e) {
				throw new Error("Storage is not available: " + e.message);
			}
		}
		generateKey(e, n) {
			const t = this.hashString(n);
			return `${this.options.prefix}-${e}-${t}`;
		}
		hashString(e) {
			let n = 0;
			for (let t = 0; t < e.length; t++) {
				(n = (n << 5) - n + e.charCodeAt(t)), (n |= 0);
			}
			return Math.abs(n).toString(36);
		}
		get(e, n) {
			try {
				const t = this.generateKey(e, n),
					o = this.options.storage.getItem(t);
				if (!o) return null;
				const r = JSON.parse(o);
				return Date.now() - r.timestamp > this.options.ttl
					? (this.delete(e, n), null)
					: r.value;
			} catch (t) {
				return console.error("Error reading from cache:", t), null;
			}
		}
		set(e, n, t) {
			try {
				const o = this.generateKey(e, n),
					r = { value: t, timestamp: Date.now() };
				this.enforceSizeLimit(),
					this.options.storage.setItem(o, JSON.stringify(r));
			} catch (o) {
				console.error("Error writing to cache:", o), this.cleanup();
			}
		}
		delete(e, n) {
			const t = this.generateKey(e, n);
			this.options.storage.removeItem(t);
		}
		enforceSizeLimit() {
			try {
				const e = this.getCacheKeys();
				if (e.length >= this.options.maxItems) {
					e.map((e) => ({
						key: e,
						timestamp: JSON.parse(this.options.storage.getItem(e)).timestamp,
					}))
						.sort((e, n) => e.timestamp - n.timestamp)
						.slice(0, e.length - this.options.maxItems + 1)
						.forEach((e) => {
							this.options.storage.removeItem(e.key);
						});
				}
			} catch (e) {
				console.error("Error enforcing cache size limit:", e);
			}
		}
		getCacheKeys() {
			const e = [];
			for (let n = 0; n < this.options.storage.length; n++) {
				const t = this.options.storage.key(n);
				t.startsWith(this.options.prefix) && e.push(t);
			}
			return e;
		}
		cleanup() {
			try {
				const e = Date.now();
				this.getCacheKeys().forEach((n) => {
					const t = JSON.parse(this.options.storage.getItem(n));
					e - t.timestamp > this.options.ttl &&
						this.options.storage.removeItem(n);
				});
			} catch (e) {
				console.error("Error during cache cleanup:", e);
			}
		}
		clear() {
			this.getCacheKeys().forEach((e) => {
				this.options.storage.removeItem(e);
			});
		}
		getStats() {
			try {
				const e = this.getCacheKeys(),
					n = Date.now();
				let t = 0,
					o = 0;
				return (
					e.forEach((e) => {
						const r = JSON.parse(this.options.storage.getItem(e));
						(t += JSON.stringify(r).length),
							n - r.timestamp > this.options.ttl && o++;
					}),
					{
						totalItems: e.length,
						expiredItems: o,
						totalSize: t,
						maxItems: this.options.maxItems,
					}
				);
			} catch (e) {
				return console.error("Error getting cache stats:", e), null;
			}
		}
	}
	class g {
		constructor(e) {
			console.log("[EditorAdapter] Initializing with editor ID:", e),
				(this.editorId = e),
				(this.editor = document.getElementById(e)),
				this.editor ||
					console.error("[EditorAdapter] Editor element not found:", e);
		}
		getContent() {
			return (
				console.log("[EditorAdapter] Getting content from editor"),
				(this.editor && (this.editor.value || this.editor.textContent)) || ""
			);
		}
		setContent(e) {
			console.log("[EditorAdapter] Setting content to editor:", e),
				this.editor
					? (void 0 !== this.editor.value
							? (this.editor.value = e)
							: (this.editor.textContent = e),
					  this.editor.dispatchEvent(new Event("change", { bubbles: !0 })))
					: console.error("[EditorAdapter] Editor not available");
		}
	}
	const v = {
			handleKeyboard(e) {
				if (e.ctrlKey || e.metaKey)
					switch (e.key.toLowerCase()) {
						case "e":
							e.preventDefault(),
								this.shadowRoot.querySelector(".modal-trigger").click();
							break;
						case "i":
							e.preventDefault(),
								this.isModalOpen() && this.handleToolAction("improve");
							break;
						case "s":
							e.preventDefault(),
								this.isModalOpen() && this.handleToolAction("summarize");
					}
			},
			handleModalKeyboard(e) {
				if (this.isModalOpen())
					switch (e.key) {
						case "Escape":
							this.shadowRoot.querySelector(".close-button").click();
							break;
						case "Tab":
							this.handleTabNavigation(e);
							break;
						case "ArrowRight":
						case "ArrowLeft":
							e.target.closest(".tools-container") &&
								this.handleToolNavigation(e);
					}
			},
			handleTabNavigation(e) {
				const n = this.shadowRoot
						.querySelector(".modal")
						.querySelectorAll(
							'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
						),
					t = n[0],
					o = n[n.length - 1];
				e.shiftKey
					? document.activeElement === t && (e.preventDefault(), o.focus())
					: document.activeElement === o && (e.preventDefault(), t.focus());
			},
			handleToolNavigation(e) {
				const n = this.shadowRoot.querySelector("ai-toolbar"),
					t = n.shadowRoot.querySelectorAll(".tool-button"),
					o = n.shadowRoot.querySelector(".tool-button:focus");
				if (!o) return;
				const r = Array.from(t).indexOf(o);
				let a;
				(a =
					"ArrowRight" === e.key
						? (r + 1) % t.length
						: (r - 1 + t.length) % t.length),
					t[a].focus(),
					e.preventDefault();
			},
		},
		f = {
			handleResponseCopy(e) {
				var n;
				console.log("[ResponseHandlers] Copy event received:", e.detail);
				const { responseId: t } = e.detail,
					o = null == (n = this.responseHistory) ? void 0 : n.getResponse(t);
				o
					? navigator.clipboard
							.writeText(o.content)
							.then(() =>
								console.log("[ResponseHandlers] Content copied to clipboard")
							)
							.catch((e) => console.error("[ResponseHandlers] Copy failed:", e))
					: console.warn("[ResponseHandlers] No response found for ID:", t);
			},
			handleResponseUse(e) {
				console.log("[ResponseHandlers] Use event received:", e.detail);
				const { responseId: n } = e.detail;
				if (!this.responseHistory)
					return void console.error(
						"[ResponseHandlers] No response history available"
					);
				if (!this.editorAdapter)
					return void console.error(
						"[ResponseHandlers] No editor adapter available"
					);
				const t = this.responseHistory.getResponse(n);
				if ((console.log("[ResponseHandlers] Found response:", t), t))
					try {
						console.log(
							"[ResponseHandlers] Setting content to editor:",
							t.content
						),
							this.editorAdapter.setContent(t.content);
					} catch (o) {
						console.error("[ResponseHandlers] Error setting content:", o);
					}
				else console.warn("[ResponseHandlers] No response found for ID:", n);
			},
			handleResponseRetry(e) {
				var n;
				console.log("[ResponseHandlers] Retry event received:", e.detail);
				const { responseId: t } = e.detail,
					o = null == (n = this.responseHistory) ? void 0 : n.getResponse(t);
				o
					? (console.log("[ResponseHandlers] Retrying action:", o.action),
					  this.handleToolAction(o.action))
					: console.warn("[ResponseHandlers] No response found for ID:", t);
			},
		},
		y = {
			isImageUsed(e) {
				if (!this.responseHistory) return !1;
				const n = e instanceof File ? e.name : e;
				return this.responseHistory.responses.some(
					(e) => "image-upload" !== e.action && e.imageUsed === n
				);
			},
			handleImageChange(e) {
				if (e) {
					(this.productImage = e), (this.productImageUrl = null);
					const n = this.responseHistory.responses.findLast(
						(e) => "chat-question" === e.action
					);
					if (n) {
						const t = this.renderImagePreview(e),
							o = this.shadowRoot.querySelector(
								`.response-entry[data-response-id="${n.id}"]`
							);
						if (o) {
							const e = o.querySelector(".response-content");
							e && e.insertAdjacentHTML("beforeend", t);
						}
						this.shadowRoot
							.querySelectorAll('.response-entry[data-action="image-upload"]')
							.forEach((e) => e.remove()),
							(this.responseHistory.responses =
								this.responseHistory.responses.filter(
									(e) => "image-upload" !== e.action
								));
					}
				}
			},
			removeImage() {
				if (this.productImage || this.productImageUrl) {
					(this.productImage = null), (this.productImageUrl = null);
					const e = this.responseHistory.responses.findLast(
						(e) => "chat-question" === e.action
					);
					e &&
						((e.content = e.content.replace(
							/<div class="image-preview-card"[\s\S]*?<\/div><\/div><\/div>/g,
							""
						)),
						this.responseHistory && this.responseHistory.render());
				}
			},
			renderImagePreview(e = null, n = !1) {
				const t = e || this.productImage || this.productImageUrl;
				if (!t) return "";
				const o = t instanceof File ? URL.createObjectURL(t) : t,
					r =
						t instanceof File
							? t.name
							: new URL(t).pathname.split("/").pop() || "From URL";
				return `\n      <div class="image-preview-card" \n           data-image-id="${Date.now()}"\n           role="figure"\n           aria-label="${
					n ? "Initial product image" : "Uploaded product image"
				}">\n        <div class="image-preview-content">\n          <div class="image-preview-thumbnail">\n            <img src="${o}" alt="Product preview - ${r}">\n          </div>\n        </div>\n      </div>\n    `;
			},
		},
		b = {
			initializeStateManager() {
				(this.stateManager = ((e) => {
					const n = {};
					return {
						updateState(t, o, r = {}) {
							const a = n[t];
							if (
								((n[t] = o),
								e.dispatchEvent(
									new CustomEvent("stateChange", {
										detail: { property: t, oldValue: a, newValue: o },
										bubbles: !1,
									})
								),
								r.rerender && e.shadowRoot)
							)
								if (r.targetSelector) {
									const n = e.shadowRoot.querySelector(r.targetSelector);
									n && "function" == typeof e.renderPart && e.renderPart(n, t);
								} else "function" == typeof e.render && e.render();
							return o;
						},
						getState: (e, t = null) => (e in n ? n[e] : t),
						getAllState: () => ({ ...n }),
						batchUpdate(t, o = {}) {
							const r = [];
							for (const [e, a] of Object.entries(t)) {
								const t = n[e];
								t !== a &&
									((n[e] = a),
									r.push({ property: e, oldValue: t, newValue: a }));
							}
							if (
								r.length > 0 &&
								(e.dispatchEvent(
									new CustomEvent("stateBatchChange", {
										detail: { changes: r },
										bubbles: !1,
									})
								),
								o.rerender && e.shadowRoot)
							)
								if (o.targetSelector && "function" == typeof e.renderPart) {
									const n = e.shadowRoot.querySelector(o.targetSelector);
									n &&
										e.renderPart(
											n,
											r.map((e) => e.property)
										);
								} else "function" == typeof e.render && e.render();
							return r.length > 0;
						},
					};
				})(this)),
					this.addEventListener(
						"stateChange",
						this.handleStateChange.bind(this)
					),
					this.addEventListener(
						"stateBatchChange",
						this.handleStateBatchChange.bind(this)
					);
			},
			handleStateChange(e) {
				const { property: n, oldValue: t, newValue: o } = e.detail;
				switch (
					(console.log(`[StateManager] Property '${n}' changed:`, t, "->", o),
					n)
				) {
					case "productImage":
						this.handleProductImageChange(t, o);
						break;
					case "enhancedText":
						this.handleEnhancedTextChange(t, o);
				}
			},
			handleStateBatchChange(e) {
				console.log("[StateManager] Batch state change:", e.detail.changes);
				if (e.detail.changes.map((e) => e.property).includes("productImage")) {
					const n = e.detail.changes.find((e) => "productImage" === e.property);
					this.handleProductImageChange(n.oldValue, n.newValue);
				}
			},
			handleProductImageChange(e, n) {
				if (n) {
					if (
						(console.log("[StateManager] New product image set:", n.name),
						this.responseHistory)
					) {
						this.responseHistory.responses.findLast(
							(e) => "chat-question" === e.action
						) && this.responseHistory.render();
					}
				} else e && console.log("[StateManager] Product image removed");
			},
			handleEnhancedTextChange(e, n) {
				console.log("[StateManager] Enhanced text updated");
			},
			requestUpdate(e = null) {
				if (
					(console.log(
						"[StateManager] Update requested for:",
						e || "entire component"
					),
					!e)
				)
					return (
						this.responseHistory && this.responseHistory.render(),
						void this.updateVisibleTools()
					);
				switch (e) {
					case "responseHistory":
						this.responseHistory && this.responseHistory.render();
						break;
					case "toolbar":
						this.updateVisibleTools();
				}
			},
		};
	class w extends HTMLElement {
		constructor() {
			var e;
			super(),
				Object.assign(this, v, f, y, b),
				customElements.get("ai-toolbar") ||
					customElements.define("ai-toolbar", s),
				customElements.get("chat-with-image") ||
					customElements.define("chat-with-image", i),
				customElements.get("response-history") ||
					customElements.define("response-history", a),
				(this.eventEmitter =
					((e = this),
					{
						emit: (n, t) => {
							const o = new CustomEvent(n, {
								detail: t,
								bubbles: !0,
								composed: !0,
							});
							e.dispatchEvent(o);
						},
						on: (n, t) => (
							e.addEventListener(n, t), () => e.removeEventListener(n, t)
						),
						off: (n, t) => {
							e.removeEventListener(n, t);
						},
					})),
				(this.responseHistory = null),
				(this.editorAdapter = null),
				(this.currentAction = "improve"),
				(this.modelManager = new d()),
				(this.markdownHandler = new p()),
				(this.tokenManager = new c()),
				this.initializeStateManager(),
				(this.cacheManager = (function (e = {}) {
					return new u(e);
				})({ prefix: "ai-text-enhancer", maxItems: 20, ttl: 18e5 })),
				this.stateManager.batchUpdate({
					enhancedText: "",
					chatMessages: [],
					isInitialized: !1,
					productImage: null,
					usageControl: null,
				}),
				this.bindMethods();
		}
		bindMethods() {
			var e, n, t, o, r, a, i, s;
			(this.handleToolAction =
				null == (e = this.handleToolAction) ? void 0 : e.bind(this)),
				(this.handleChatMessage =
					null == (n = this.handleChatMessage) ? void 0 : n.bind(this)),
				(this.handleResponseCopy =
					null == (t = this.handleResponseCopy) ? void 0 : t.bind(this)),
				(this.handleResponseUse =
					null == (o = this.handleResponseUse) ? void 0 : o.bind(this)),
				(this.handleResponseRetry =
					null == (r = this.handleResponseRetry) ? void 0 : r.bind(this)),
				(this.handleResponseEdit =
					null == (a = this.handleResponseEdit) ? void 0 : a.bind(this)),
				(this.handleKeyboard =
					null == (i = this.handleKeyboard) ? void 0 : i.bind(this)),
				(this.handleModalKeyboard =
					null == (s = this.handleModalKeyboard) ? void 0 : s.bind(this));
		}
		static get observedAttributes() {
			return [
				"editor-id",
				"api-key",
				"api-provider",
				"api-model",
				"language",
				"prompt",
				"context",
				"image-url",
				"tenant-id",
				"user-id",
				"quota-endpoint",
				"proxy-endpoint",
			];
		}
		get language() {
			return this.getAttribute("language") || "en";
		}
		get translations() {
			return e[this.language] || e.en;
		}
		get editorId() {
			return this.getAttribute("editor-id");
		}
		get apiKey() {
			return this.getAttribute("api-key");
		}
		get prompt() {
			return (
				this.getAttribute("prompt") ||
				"You are a professional content enhancer. Improve the text while maintaining its core message and intent."
			);
		}
		get currentContent() {
			var e;
			return (null == (e = this.editorAdapter) ? void 0 : e.getContent()) || "";
		}
		get apiProvider() {
			return this.getAttribute("api-provider") || "openai";
		}
		get apiModel() {
			var e;
			const n = this.getAttribute("api-model");
			try {
				return null == (e = this.modelManager.getModelConfig(n))
					? void 0
					: e.id;
			} catch {
				return this.modelManager.getDefaultModel();
			}
		}
		get imageUrl() {
			return this.getAttribute("image-url");
		}
		get context() {
			return this.getAttribute("context") || "";
		}
		get proxyEndpoint() {
			return this.getAttribute("proxy-endpoint");
		}
		async connectedCallback() {
			try {
				!(function (e, n) {
					console.log("Attaching shadow template to component:", {
						componentTagName: e.tagName,
						hasTemplate: !!n,
					});
					const t = e.attachShadow({ mode: "open" });
					console.log("Shadow root created:", !!t);
					const o = document.createElement("template");
					(o.innerHTML = n),
						console.log(
							"Template element created with content length:",
							o.innerHTML.length
						);
					const r = o.content.cloneNode(!0);
					console.log("Content cloned:", {
						hasContent: !!r,
						childNodes: r.childNodes.length,
					}),
						t.appendChild(r),
						console.log("Content appended to shadow root"),
						console.log("Rendered elements:", {
							modalTrigger: t.querySelector(".modal-trigger"),
							modal: t.querySelector(".modal"),
							aiToolbar: t.querySelector("ai-toolbar"),
							chatWithImage: t.querySelector("chat-with-image"),
							responseHistory: t.querySelector("response-history"),
						});
				})(
					this,
					(function (e) {
						const n = e.translations;
						return `\n    <style>\n      ${t}\n      ${o}\n      \n  .modal-trigger {\n    position: relative;\n    display: inline-flex;\n    align-items: center;\n    justify-content: center;\n    padding: 0.75rem 1.25rem;\n    background: linear-gradient(to right, var(--ai-gradient-start) 0%, var(--ai-gradient-middle) 51%, var(--ai-gradient-end) 100%);\n    background-size: 200% auto;\n    border: 0;\n    border-radius: 2em;\n    color: white;\n    font-family: var(--ai-font-sans);\n    font-weight: 600;\n    cursor: pointer;\n    transition: all 0.3s ease;\n    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);\n    white-space: nowrap;\n    box-shadow: var(--ai-shadow);\n  }\n\n  .modal-trigger::before {\n    content: "";\n    position: absolute;\n    inset: 0;\n    opacity: 0;\n    background: linear-gradient(45deg, #fb0094, #0000ff, #00ff00, #ffff00, #ff0000);\n    background-size: 400%;\n    border-radius: 2em;\n    z-index: -1;\n    transition: opacity 0.3s ease;\n    animation: glow 5s linear infinite;\n  }\n\n  .modal-trigger:hover {\n    background-position: right center;\n    box-shadow: var(--ai-shadow-md);\n    transform: translateY(-1px);\n  }\n\n  .modal-trigger:hover::before {\n    opacity: 0.7;\n    filter: blur(8px);\n  }\n\n  .modal-trigger svg {\n    width: 1.25em;\n    height: 1.25em;\n    margin-right: 0.5em;\n    transition: transform 0.3s ease;\n  }\n\n  .modal-trigger:hover svg {\n    animation: shake 0.5s ease-in-out;\n  }\n\n  .modal-trigger span {\n    font-size: 0.9375rem;\n    letter-spacing: 0.025em;\n  }\n\n      \n  .modal {\n    display: none;\n    position: fixed;\n    top: 0;\n    left: 0;\n    width: 100%;\n    height: 100%;\n    background: rgba(0, 0, 0, 0.5);\n    z-index: var(--ai-z-modal);\n  }\n\n  .modal.open {\n    display: block;\n  }\n\n  .modal-content {\n    position: relative;\n    background: var(--ai-background);\n    width: 95%;\n    max-width: 1200px;\n    height: 85vh;\n    margin: 5vh auto;\n    padding: 1.5rem;\n    border-radius: var(--ai-radius-lg);\n    box-shadow: var(--ai-shadow-md);\n    display: flex;\n    flex-direction: column;\n    z-index: var(--ai-z-content);\n  }\n\n  .modal-header {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n    margin-bottom: 1.5rem;\n  }\n\n  .modal-header h2 {\n    margin: 0;\n    font-size: 1.5rem;\n    font-weight: 600;\n    color: var(--ai-text);\n  }\n\n  .modal-body {\n    flex: 1;\n    display: flex;\n    flex-direction: column;\n    min-height: 0;\n    overflow: hidden;\n    position: relative;\n  }\n\n  .editor-section {\n    flex: 1;\n    display: flex;\n    flex-direction: column;\n    min-height: 0;\n    overflow: hidden;\n  }\n\n  .image-upload-section {\n    margin-bottom: 1rem;\n  }\n\n  .tools-container {\n    margin-bottom: 1rem;\n  }\n\n  .chat-section {\n    flex-shrink: 0;\n  }\n\n  .close-button {\n    position: absolute;\n    top: 1rem;\n    right: 1rem;\n    background: none;\n    border: none;\n    font-size: 1.5rem;\n    cursor: pointer;\n    color: var(--ai-text-light);\n    transition: color 0.2s ease;\n    z-index: 1;\n  }\n\n  .close-button:hover {\n    color: var(--ai-text);\n  }\n\n      ${r}\n      \n  .image-preview-card {\n    background: var(--ai-background);\n    border: 1px solid var(--ai-border);\n    border-radius: var(--ai-radius);\n    padding: 1rem;\n    margin-bottom: 1rem;\n    animation: fadeIn 0.3s ease forwards;\n  }\n\n  .image-preview-content {\n    display: flex;\n    align-items: flex-start;\n    gap: 1rem;\n  }\n\n  .image-preview-thumbnail {\n    width: 96px;\n    height: 96px;\n    position: relative;\n    border-radius: var(--ai-radius);\n    overflow: hidden;\n    background: var(--ai-background-light);\n  }\n\n  .image-preview-thumbnail img {\n    width: 100%;\n    height: 100%;\n    object-fit: cover;\n  }\n\n  .image-preview-info {\n    flex: 1;\n  }\n\n  .image-preview-label {\n    font-size: 0.875rem;\n    color: var(--ai-text-light);\n    margin-bottom: 0.25rem;\n  }\n\n  .image-preview-filename {\n    font-size: 0.875rem;\n    color: var(--ai-text);\n  }\n\n  .image-preview-remove {\n    padding: 0.25rem;\n    border: none;\n    background: none;\n    color: var(--ai-text-light);\n    cursor: pointer;\n    opacity: 0.7;\n    transition: all 0.2s ease;\n  }\n\n  .image-preview-remove:hover {\n    opacity: 1;\n    color: var(--ai-text);\n  }\n\n  /* Estilos para el botón de upload en el chat */\n  .chat-actions {\n    display: flex;\n    align-items: center;\n    gap: 0.5rem;\n    margin-bottom: 1rem;\n  }\n\n  .chat-upload-button {\n    display: inline-flex;\n    align-items: center;\n    gap: 0.5rem;\n    padding: 0.375rem 0.75rem;\n    background: var(--ai-background-light);\n    border: 1px solid var(--ai-border);\n    border-radius: var(--ai-radius);\n    color: var(--ai-text);\n    font-size: 0.875rem;\n    cursor: pointer;\n    transition: all 0.2s ease;\n  }\n\n  .chat-upload-button:hover {\n    background: var(--ai-secondary);\n    border-color: var(--ai-border);\n  }\n\n  .chat-upload-button svg {\n    width: 16px;\n    height: 16px;\n  }\n\n  /* Ocultar input de archivo */\n  .hidden {\n    display: none !important;\n  }\n\n      \n      :host {\n        display: inline-block;\n        font-family: var(--ai-font-sans);\n        position: relative;\n      }\n\n      .editor-section {\n        flex: 1;\n        display: flex;\n        flex-direction: column;\n        min-height: 0;\n      }\n\n      .chat-section {\n        position: absolute;\n        width: 100%;\n        bottom: 0;\n        left: 0;\n      }\n\n      .tools-container {\n        margin-bottom: 1rem;\n      }\n\n      response-history {\n        flex: 1;\n        min-height: 0;\n        background: var(--ai-background);\n        border-radius: var(--ai-radius);\n        margin-bottom: 1rem;\n        overflow: auto;\n        display: block;\n      }\n    </style>\n\n    <button class="modal-trigger">\n      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">\n        <path d="m21.64 3.64-1.28-1.28a1.21 1.21 0 0 0-1.72 0L2.36 18.64a1.21 1.21 0 0 0 0 1.72l1.28 1.28a1.2 1.2 0 0 0 1.72 0L21.64 5.36a1.2 1.2 0 0 0 0-1.72"/>\n        <path d="m14 7 3 3"/>\n      </svg>\n      <span>${
							(null == n ? void 0 : n.modalTrigger) || "Enhance Text"
						}</span>\n    </button>\n    \n    <div class="modal">\n      <div class="modal-content">\n        <button class="close-button">×</button>\n        <div class="modal-header">\n          <h2>${
							(null == n ? void 0 : n.modalTrigger) || "Enhance Text"
						}</h2>\n        </div>\n        \n        <div class="modal-body">\n          <div class="editor-section">\n            <response-history language="${
							e.language
						}"></response-history>\n          </div>\n          <div class="chat-section">\n            <chat-with-image\n              language="${
							e.language
						}"\n              image-url="${
							e.imageUrl || ""
						}"\n              api-provider="${
							e.apiProvider
						}">\n            </chat-with-image>\n          </div>\n        </div>\n      </div>\n    </div>`;
					})(this)
				),
					this.updateLanguageForChildren(this.language),
					this.setupEventListeners(),
					(function (e) {
						document.addEventListener("keydown", e.handleKeyboard.bind(e));
						const n = e.shadowRoot.querySelector(".modal");
						n && n.addEventListener("keydown", e.handleModalKeyboard.bind(e));
					})(this),
					await this.initializeComponents();
			} catch (e) {
				console.error("Error initializing component:", e),
					this.notificationManager &&
						this.notificationManager.error(
							`Initialization error: ${e.message}`
						);
			}
		}
		attributeChangedCallback(e, n, t) {
			if (
				(console.log(
					"[AITextEnhancer] Attribute changed:",
					e,
					"from",
					n,
					"to",
					t
				),
				n !== t)
			)
				switch (e) {
					case "api-key":
						this.apiClient
							? this.apiClient.setApiKey(t)
							: this.isInitialized || this.initializeComponents();
						break;
					case "language":
						this.updateLanguageForChildren(t);
						break;
					case "api-provider":
					case "api-model":
					case "proxy-endpoint":
						this.isInitialized &&
							this.apiClient &&
							this.apiClient.updateConfig({
								provider: this.apiProvider,
								model: this.apiModel,
								proxyEndpoint: this.proxyEndpoint,
							});
						break;
					case "image-url":
						if (this.isInitialized) {
							const e = this.shadowRoot.querySelector("chat-with-image");
							e && e.setAttribute("image-url", t || "");
						}
				}
		}
		updateLanguageForChildren(e) {
			if (
				(console.log("[AITextEnhancer] Updating language for children:", e),
				!this.shadowRoot)
			)
				return void console.warn(
					"[AITextEnhancer] No shadowRoot available yet"
				);
			const n = this.shadowRoot.querySelector(".modal-trigger span"),
				t = this.shadowRoot.querySelector(".modal-header h2");
			if (
				(n &&
					((n.textContent = this.translations.modalTrigger || "Enhance Text"),
					console.log(
						"[AITextEnhancer] Updated modal trigger text:",
						n.textContent
					)),
				t &&
					((t.textContent = this.translations.modalTitle || "Enhance Text"),
					console.log(
						"[AITextEnhancer] Updated modal title text:",
						t.textContent
					)),
				this.modalTriggerHandler)
			) {
				const e = this.shadowRoot.querySelector(".modal-trigger");
				e &&
					(e.removeEventListener("click", this.modalTriggerHandler),
					e.addEventListener("click", this.modalTriggerHandler));
			}
			const o = this.shadowRoot.querySelectorAll("[language]");
			console.log("[AITextEnhancer] Found components to update:", o.length),
				o.forEach((n) => {
					const t = n.getAttribute("language");
					n.setAttribute("language", e),
						console.log("[AITextEnhancer] Updated component language:", {
							component: n.tagName,
							from: t,
							to: e,
						});
				});
			[
				this.shadowRoot.querySelector("ai-toolbar"),
				this.shadowRoot.querySelector("chat-with-image"),
				this.shadowRoot.querySelector("response-history"),
			].forEach((n) => {
				n &&
					(n.setAttribute("language", e),
					console.log(
						"[AITextEnhancer] Forced language update on:",
						n.tagName
					));
			});
		}
		setupEventListeners() {
			const e = this.shadowRoot.querySelector("chat-with-image");
			e && e.addEventListener("chatMessage", this.handleChatMessage),
				(this.responseHistory =
					this.shadowRoot.querySelector("response-history")),
				this.responseHistory &&
					(this.responseHistory.addEventListener(
						"responseCopy",
						this.handleResponseCopy
					),
					this.responseHistory.addEventListener(
						"responseUse",
						this.handleResponseUse
					),
					this.responseHistory.addEventListener(
						"responseRetry",
						this.handleResponseRetry
					),
					this.responseHistory.addEventListener(
						"responseEdit",
						this.handleResponseEdit
					),
					this.responseHistory.addEventListener(
						"toolaction",
						this.handleToolAction
					)),
				this.addEventListener("configurationUpdated", (e) => {
					console.log("[AITextEnhancer] Configuration updated:", e.detail),
						this.isInitialized &&
							this.initializeComponents().catch((e) => {
								console.error("Error reinitializing components:", e);
							});
				}),
				this.bindEvents();
		}
		bindEvents() {
			const e = this.shadowRoot.querySelector(".modal"),
				n = this.shadowRoot.querySelector(".modal-trigger");
			if (!e || !n)
				return void console.warn(
					"[AITextEnhancer] Modal elements not found in bindEvents"
				);
			(this.modalTriggerHandler = () => {
				console.log("[AITextEnhancer] Current attributes when modal opens:", {
					apiKey: this.apiKey,
					provider: this.apiProvider,
					model: this.apiModel,
					language: this.language,
					prompt: this.prompt,
					context: this.context,
					imageUrl: this.imageUrl,
				}),
					e.classList.add("open"),
					this.updateVisibleTools();
			}),
				n.removeEventListener("click", this.modalTriggerHandler),
				n.addEventListener("click", this.modalTriggerHandler);
			const t = this.shadowRoot.querySelector(".close-button");
			t && (t.onclick = () => e.classList.remove("open")),
				(e.onclick = (n) => {
					n.target === e && e.classList.remove("open");
				});
			const o = this.shadowRoot.querySelector("ai-toolbar");
			o && o.addEventListener("toolaction", this.handleToolAction);
		}
		async initializeComponents() {
			if (!this.isInitialized)
				try {
					await this.markdownHandler.initialize(),
						console.log("[AITextEnhancer] Markdown handler initialized");
					const e =
						this.proxyEndpoint || "http://llmproxy.test:8080/api/llm-proxy";
					(this.apiClient = (function (e = {}) {
						return new h(e);
					})({
						provider: this.apiProvider,
						model: this.apiModel,
						systemPrompt: this.prompt,
						temperature: 0.7,
						proxyEndpoint: e,
						tenantId: this.getAttribute("tenant-id") || "default",
						userId: this.getAttribute("user-id") || "default",
					})),
						this.editorId && (this.editorAdapter = new g(this.editorId));
					const n = this.shadowRoot.querySelector("response-history");
					n &&
						((n.markdownHandler = this.markdownHandler),
						console.log(
							"[AITextEnhancer] Markdown handler passed to response history"
						)),
						(this.isInitialized = !0),
						this.updateVisibleTools();
				} catch (e) {
					throw (
						(console.error("Error in initializeComponents:", e),
						this.addResponseToHistory(
							"error",
							`Initialization error: ${e.message}`
						),
						e)
					);
				}
		}
		isModalOpen() {
			return this.shadowRoot.querySelector(".modal").classList.contains("open");
		}
		updateVisibleTools() {
			const e = Boolean(this.currentContent.trim()),
				n = this.shadowRoot.querySelector("ai-toolbar");
			n && n.setAttribute("has-content", e.toString());
		}
		async handleChatMessage(e) {
			const { message: n, image: t } = e.detail;
			try {
				if (!(null == n ? void 0 : n.trim()) && !t)
					throw new Error("Message cannot be empty");
				const e = {
					id: Date.now(),
					action: "chat-question",
					content: `**${this.translations.chat.question}:** ${n}`,
					timestamp: new Date(),
					image: t,
				};
				this.responseHistory.addResponse(e);
				const o = Date.now() + 1;
				this.responseHistory.addResponse({
					id: o,
					action: "chat-response",
					content: "",
					timestamp: new Date(),
				});
				const r = (e) => {
					this.responseHistory.updateResponse(o, (n) => n + e);
				};
				await this.apiClient.chatResponse(this.currentContent, n.trim(), t, r),
					setTimeout(() => {
						const e = this.shadowRoot.querySelector(".response-container");
						e && (e.scrollTop = e.scrollHeight);
					}, 200);
			} catch (o) {
				console.error("Chat Error:", o);
				const e = this.formatErrorMessage(o);
				this.addResponseToHistory("chat-error", e);
			}
		}
		requestUpdate(e = null) {
			return this.stateManager.triggerUpdate(e);
		}
		async handleToolAction(e) {
			const { action: n, responseId: t, content: o } = e.detail;
			let r = null;
			try {
				const e = this.cacheManager.get(n, o);
				if (e) return void this.addResponseToHistory(n, e);
				(r = {
					id: Date.now(),
					action: n,
					content: '<span class="typing">|</span>',
					timestamp: new Date(),
				}),
					this.responseHistory.addResponse(r),
					(this.apiClient && this.stateManager.get("isInitialized")) ||
						(await this.initializeComponents());
				const t = (e) => {
						this.responseHistory.updateResponse(
							r.id,
							(n) => n.replace('<span class="typing">|</span>', "") + e
						);
					},
					a = await this.apiClient.enhanceText(o, n, null, this.context, t);
				a.includes('<span class="typing">|</span>') ||
					(this.responseHistory.removeResponse(r.id),
					this.addResponseToHistory(n, a)),
					this.cacheManager.set(n, o, a);
			} catch (a) {
				console.error("Error in handleToolAction:", a),
					r && this.responseHistory.removeResponse(r.id),
					this.addResponseToHistory("error", a.message || "An error occurred");
			}
		}
		formatErrorMessage(e) {
			return e.message.includes("CORS")
				? "Error: Unable to connect to AI service. Please check your API key and try again."
				: e.message.includes("Failed to fetch")
				? "Error: Network connection failed. Please check your internet connection."
				: `Error: ${e.message}`;
		}
		addResponseToHistory(e, n) {
			const t = {
				id: Date.now(),
				action: e,
				content: n,
				timestamp: new Date(),
			};
			this.responseHistory.addResponse(t);
		}
	}
	return customElements.define("ai-text-enhancer", w), w;
});
//# sourceMappingURL=ai-text-enhancer.umd.js.map
