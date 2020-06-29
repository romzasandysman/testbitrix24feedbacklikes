BX.ready(function(){
    let vues = document.querySelectorAll(".js-likes");
    let each = Array.prototype.forEach;

    each.call(vues, (el, index) => {
            let $el = $(el);

           let vm = BX.Vue.create({
                el,
                data: {
                    disabled: true,
                    countLikes: '..Loading',
                    countDisLikes: '..Loading',
                },
                methods: {
                    sendDisLike: function (e, ip, idItem) {
                        axios.post(SITE_DIR + 'ajax/addDisLike.php', this.getFormData(ip, idItem))
                            .then(function (response) {
                                let data = response.data;
                                if (data.success) {
                                    this.setActiveLike(e);
                                    this.disabled = true;
                                    this.countLikes = data.count;
                                } else {
                                    console.log(data.message);
                                }
                            })
                            .catch(function (e) {
                                console.log(e);
                            })
                    },

                    sendLike: function (e, ip, idItem) {
                        axios.post(SITE_DIR + 'ajax/addLike.php', this.getFormData(ip, idItem))
                            .then(function (response) {
                                let data = response.data;
                                if (data.success) {
                                    this.setActiveLike(e);
                                    this.disabled = true;
                                    this.countDisLikes = data.count;
                                } else {
                                    console.log(data.message);
                                }
                            })
                            .catch(function (e) {
                                console.log(e);
                            })
                    },

                    getFormData: function (ip, idItem) {
                        let formData = new FormData();
                        formData.append('ip', ip);
                        formData.append('itemID', idItem);

                        return formData;
                    },

                    setActiveLike: function (e) {
                        $(e.targetEvent).addClass('active');
                    }
                }
            });

           $el.data('vm', vm);
        },
    );

    let getCountsLikes = function(elements){
        let itemsIds = [],
            formData = new FormData();

        $.each(elements, function () {
            itemsIds.push($(this).data('id'));
        })

        formData.append('itemsID', JSON.stringify(itemsIds));

        axios.post(SITE_DIR + 'ajax/getCountLikes.php', formData)
            .then(function (response) {
                let data = response.data;
                if (data.data_count) {
                    $.each(elements, function () {
                        let $this = $(this),
                            id = $this.data('id'),
                            vm = $this.data('vm');
                        vm.countLikes = data.data_count[id].COUNT_LIKES;
                        vm.countDisLikes = data.data_count[id].COUNT_DIS_LIKES;
                        vm.disabled = !!data.data_count[id].HAS_LIKE_FROM_USER;
                    })
                }
            })
            .catch(function (e) {
                console.log(e);
            })
    };

    _.delay(function(elements){
        getCountsLikes(elements)
    }, 100, vues);
});