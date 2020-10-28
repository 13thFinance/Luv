const ReportPrompt = {
    open (options) {
        options = Object.assign({}, {
            title: '',
            message: '',
            okText: 'OK',
            cancelText: 'Cancel',
            onok: function () {},
            oncancel: function () {}
        }, options);
        
        const html = `
            <div class="confirm">
                <div class="confirm__window">
                    <div class="confirm__titlebar">
                        <span class="confirm__title">${options.title}</span>
                        <button class="confirm__close">&times;</button>
                    </div>
                    <div class="confirm__content">${options.message}</div>
                    
                    <div class="confirm__content">
                        <textarea name="report-text" id="form-report-text-id" rows = "12" cols = "72"></textarea>
                    </div>
                    
                    <div class="confirm__buttons">
                        <button class="confirm__button confirm__button--ok confirm__button--fill">${options.okText}</button>
                        <button class="confirm__button confirm__button--cancel">${options.cancelText}</button>
                    </div>
                </div>
            </div>
        `;

        const template = document.createElement('template');
        template.innerHTML = html;

        // Elements
        const confirmEl = template.content.querySelector('.confirm');
        const btnClose = template.content.querySelector('.confirm__close');
        const btnOk = template.content.querySelector('.confirm__button--ok');
        const btnCancel = template.content.querySelector('.confirm__button--cancel');

        confirmEl.addEventListener('click', e => {
            if (e.target === confirmEl) {
                options.oncancel();
                this._close(confirmEl);
            }
        });

        btnOk.addEventListener('click', () => {
            options.onok();
            this._close(confirmEl);
        });

        [btnCancel, btnClose].forEach(el => {
            el.addEventListener('click', () => {
                options.oncancel();
                this._close(confirmEl);
            });
        });

        document.body.appendChild(template.content);
    },

    _close (confirmEl) {
        confirmEl.classList.add('confirm--close');

        confirmEl.addEventListener('animationend', () => {
            document.body.removeChild(confirmEl);
        });
    }
};


//======================================================================
// Review Prompt

const ReviewPrompt = {
    open (options) {
        options = Object.assign({}, {
            title: '',
            message: '',
            okText: 'OK',
            cancelText: 'Cancel',
            onok: function () {},
            oncancel: function () {}
        }, options);
        
        const html = `
            <div class="confirm">
                <div class="confirm__window">
                    <div class="confirm__titlebar">
                        <span class="confirm__title">${options.title}</span>
                        <button class="confirm__close">&times;</button>
                    </div>
                    <div class="confirm__content">${options.message}</div>
                    
                    <div class="confirm__content">
                        <textarea name="report-text" id="form-review-text-id" rows = "12" cols = "72"></textarea>
                    </div>

                    <div class="form-review-stars-div">
                        <form action="" class="review-rating-form">
                            <input type="radio" name="review-rating" id="form-review-rating-id1-readonly" class="review-rating-id" value="rating">
                            <label for="form-review-rating-id1-readonly" class="rating-start-label">1 Star</label>

                            <input type="radio" name="review-rating" id="form-review-rating-id2-readonly" class="review-rating-id" value="rating">
                            <label for="form-review-rating-id2-readonly" class="rating-start-label">2 Stars</label>

                            <input type="radio" name="review-rating" id="form-review-rating-id3-readonly" class="review-rating-id" value="rating">
                            <label for="form-review-rating-id3-readonly" class="rating-start-label">3 Stars</label>

                            <input type="radio" name="review-rating" id="form-review-rating-id4-readonly" class="review-rating-id" value="rating">
                            <label for="form-review-rating-id4-readonly" class="rating-start-label">4 Stars</label>

                            <input type="radio" name="review-rating" id="form-review-rating-id5-readonly" class="review-rating-id" value="rating">
                            <label for="form-review-rating-id5-readonly" class="rating-start-label">5 Stars</label>
                        </form>
                    </div>
                    
                    <div class="confirm__buttons">
                        <button class="confirm__button confirm__button--ok confirm__button--fill">${options.okText}</button>
                        <button class="confirm__button confirm__button--cancel">${options.cancelText}</button>
                    </div>
                </div>
            </div>
        `;

        const template = document.createElement('template');
        template.innerHTML = html;

        // Elements
        const confirmEl = template.content.querySelector('.confirm');
        const btnClose = template.content.querySelector('.confirm__close');
        const btnOk = template.content.querySelector('.confirm__button--ok');
        const btnCancel = template.content.querySelector('.confirm__button--cancel');

        confirmEl.addEventListener('click', e => {
            if (e.target === confirmEl) {
                options.oncancel();
                this._close(confirmEl);
            }
        });

        btnOk.addEventListener('click', () => {
            options.onok();
            this._close(confirmEl);
        });

        [btnCancel, btnClose].forEach(el => {
            el.addEventListener('click', () => {
                options.oncancel();
                this._close(confirmEl);
            });
        });

        document.body.appendChild(template.content);
    },

    _close (confirmEl) {
        confirmEl.classList.add('confirm--close');

        confirmEl.addEventListener('animationend', () => {
            document.body.removeChild(confirmEl);
        });
    }
};
