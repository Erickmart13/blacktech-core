window.openModal = function (modalId, recordId, routeTemplate) {
    const event = new CustomEvent('open-modal', {
        detail: {
            id: modalId,
            recordId: recordId,
            route: routeTemplate,
        }
    });
    window.dispatchEvent(event);
};
