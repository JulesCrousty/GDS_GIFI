(function () {
    const serialInput = document.getElementById('serial-number');
    const scanPanel = document.getElementById('scan-panel');
    const openManualButton = document.getElementById('open-manual-serial');
    const manualModal = document.getElementById('manual-serial-modal');
    const manualForm = document.getElementById('manual-serial-form');
    const manualInput = document.getElementById('manual-serial-input');
    const closeManualButton = document.getElementById('close-manual-serial');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const notesField = document.getElementById('notes');

    const autoNoteTriggers = document.querySelectorAll('.auto-note-trigger, #serial-number, #article, #attribution');

    const openModal = () => {
        manualModal?.removeAttribute('hidden');
        modalBackdrop?.removeAttribute('hidden');
        manualInput?.focus();
    };

    const closeModal = () => {
        manualModal?.setAttribute('hidden', '');
        modalBackdrop?.setAttribute('hidden', '');
        manualForm?.reset();
        serialInput?.focus();
    };

    const ensureNoteMarker = () => {
        if (!notesField) {
            return;
        }

        if (notesField.dataset.userEdited === 'true') {
            return;
        }

        if (notesField.value.trim() === '') {
            notesField.value = 'x';
        }
    };

    const markNotesAsEdited = () => {
        if (!notesField) {
            return;
        }

        const value = notesField.value.trim();
        if (value === '' || value === 'x') {
            notesField.dataset.userEdited = '';
        } else {
            notesField.dataset.userEdited = 'true';
        }
    };

    if (serialInput) {
        serialInput.focus();
    }

    scanPanel?.addEventListener('click', () => {
        serialInput?.focus();
    });

    openManualButton?.addEventListener('click', () => {
        openModal();
    });

    closeManualButton?.addEventListener('click', () => {
        closeModal();
    });

    modalBackdrop?.addEventListener('click', () => {
        closeModal();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && manualModal && !manualModal.hasAttribute('hidden')) {
            closeModal();
        }
    });

    manualForm?.addEventListener('submit', (event) => {
        event.preventDefault();
        const value = manualInput?.value.trim();

        if (!value) {
            manualInput?.focus();
            return;
        }

        if (serialInput) {
            serialInput.value = value;
            serialInput.dispatchEvent(new Event('input'));
        }

        ensureNoteMarker();
        closeModal();
    });

    autoNoteTriggers.forEach((element) => {
        element.addEventListener('input', ensureNoteMarker);
        element.addEventListener('change', ensureNoteMarker);
    });

    notesField?.addEventListener('input', () => {
        markNotesAsEdited();
    });

    markNotesAsEdited();
    ensureNoteMarker();
})();
