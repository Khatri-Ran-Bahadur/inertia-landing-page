export const translations = {
    methods: {
        __(key, replacements = {}) {
            let translation = this.$page.props.translations[key] || key;
            Object.keys(replacements).forEach((r) => {
                translation = translation.replace(`:${r}`, replacements[r]);
            });
            return translation;
        },
    },
};
