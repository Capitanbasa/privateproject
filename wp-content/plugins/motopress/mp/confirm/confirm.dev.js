steal('jquery/controller','jquery/view/ejs')
    .then('mp/confirm/views/init.ejs' + motopress.pluginVersionParam, function($){
    /**
     * @class MP.Confirm
     */
    $.Controller('MP.Confirm',
    /** @Static */
    {
        myThis: null,

        show: function(title, message, action) {
            if (typeof title !== 'undefined' && typeof message !== 'undefined' && typeof action !== 'undefined') {
                MP.Confirm.myThis.title.text(title);
                MP.Confirm.myThis.message.text(message);
                MP.Confirm.myThis.yesBtn.attr('data-motopress-action', action);
                MP.Confirm.myThis.element.modal('show');
            }
        }
    },
    /** @Prototype */
    {
        title: null,
        message: null,
        yesBtn: null,

        init: function() {
            MP.Confirm.myThis = this;

            this.element.html("//mp/confirm/views/init.ejs" + motopress.pluginVersionParam, {
                action: null,
                yes: localStorage.getItem('yes'),
                no: localStorage.getItem('no')
            });

            this.element.on('hide', this.proxy('hideConfirmModal'));

            this.title = this.element.find('#confirmModalLabel');
            this.message = this.element.find('#confirmModalMessage');
            this.yesBtn = this.element.find('#motopress-confirm-yes');
        },

        '#motopress-confirm-yes click': function(el) {
            var action = el.attr('data-motopress-action');

            this.element.modal('hide');

            switch(action) {
                case 'save':
                    MP.Navbar.myThis.save(false);
                    break;
                case 'reset':
                    MP.Navbar.myThis.reset();
                    break;
                case 'visit-site':
                    MP.Navbar.myThis.save(true);
                    break;
            }
        },

        hideConfirmModal: function() {
            this.title.text('');
            this.message.text('');
            this.yesBtn.removeAttr('data-motopress-action');
        }
    })
});