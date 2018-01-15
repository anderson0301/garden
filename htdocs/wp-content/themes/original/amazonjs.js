(function($) {
  $.amazonjs.addTemplate(function(partial) {
    return {
      'Original': [
        '<div class="amazon-box">',
          '<div class="amazon-box__image">',
            '<a href="${DetailPageURL}">',
              '{{if MediumImage}}<img src="${MediumImage.src}">{{/if}}',
            '</a>',
          '</div>',
          '<div class="amazon-box__body">',
            '<div class="amazon-box__title">${Title}</div>',
            '<a href="${DetailPageURL}" data-asin="${ASIN}" class="amazon-box__button"><i class="fa fa-amazon"></i>クリックして今すぐチェック</a>',
          '</div>',
        '</div>'
      ].join('')
    };
  });
})(jQuery);