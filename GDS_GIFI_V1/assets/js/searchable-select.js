(function () {
    const container = document.querySelector('.searchable-select');
    if (!container) {
        return;
    }

    const input = container.querySelector('input[type="text"]');
    const suggestions = container.querySelector('.suggestions');
    const dataset = JSON.parse(container.dataset.articles || '[]');

    function renderSuggestions(items) {
        suggestions.innerHTML = '';

        if (!items.length) {
            suggestions.classList.remove('active');
            return;
        }

        const fragment = document.createDocumentFragment();
        items.forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = item.label;
            button.addEventListener('click', () => {
                input.value = item.label;
                input.dataset.value = item.value;
                suggestions.classList.remove('active');
                suggestions.innerHTML = '';
            });
            fragment.appendChild(button);
        });

        suggestions.appendChild(fragment);
        suggestions.classList.add('active');
    }

    function filter(query) {
        if (!query) {
            renderSuggestions(dataset.slice(0, 10));
            return;
        }

        const filtered = dataset.filter((item) =>
            item.label.toLowerCase().includes(query.toLowerCase())
        );

        renderSuggestions(filtered.slice(0, 10));
    }

    input.addEventListener('focus', () => filter(input.value));

    input.addEventListener('input', (event) => {
        filter(event.target.value);
    });

    document.addEventListener('click', (event) => {
        if (!container.contains(event.target)) {
            suggestions.classList.remove('active');
        }
    });
})();
