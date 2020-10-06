system.controller("ArticleBeautyController", ArticleBeautyController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function ArticleBeautyController($scope, $http, $rootScope, $timeout, Upload) {
    $scope.controllerName = "ArticleBeautyController";
    $scope.pageId = 0;
    $scope.filter = {
        key: ""
    };
    $scope.editArticle = {};
    $scope.listCategory = listCategory;
    $scope.listStatus = [
        {value: 'enable', name: 'Enable'},
        {value: 'disable', name: 'Disable'}
    ];
    $scope.newArticle = {

    };
    $scope.listProcedure = [];
    $scope.listProcedureEdit = [];
    $scope.baseController = this.__proto__ = new BaseController($scope, $http, $rootScope);
    this.initialize = function(){
        $scope.find();
    }
    $scope.find = function(){
        $('#searchParamButton').button('loading');
        var param = {
            api_token: api_token,
            page_id: $scope.pageId + 1,
            type_article: 'advance'

        };
        if ($scope.filter.search_article) {
            param.search_article = $scope.filter.search_article;
        }
        if ($scope.filter.status) {
            param.status = $scope.filter.status;
        }
        if ($scope.filter.category) {
            param.category = $scope.filter.category;
        }
        url = api_domain + "/api/article/index";
        $http({
            url: url,
            method: "GET",
            params: param,
            header: {
                'Content-Type': 'application/json',
            }
        }).then(
            function(response){
                if (response.data.status == 'successful') {
                    $scope.articles = response.data.data;
                    $scope.articles = getIntValOrder($scope.articles);
                    $scope.pageId = response.data.paginator.off_set / response.data.paginator.limit;
                    $scope.pagesCount = response.data.paginator.page_count;
                } else {
                    showMessage('Error', 'There was an error processing, please try again!', 'error');
                }
                $('#searchParamButton').button('reset');
            }
        );
    };

    function getIntValOrder(articles) {
        for (var index = 0; index < articles.length; ++index) {
            articles[index].order = parseInt(articles[index].order);
        }
        return articles;
    }

    $scope.showCreateArticleForm = function(){
        tinymce.remove();
        $scope.newArticle = {};
        $scope.newArticle.status = $scope.listStatus[0].value;
        $scope.previewImg = "";
        $('.create-tab').removeClass('active');
        $('.create-tab-active').addClass('active');
        $('#createArticleForm').modal('show');
        $scope.listProcedure = [
            {id: 1}
        ];
        $scope.baseController.initTinymce("#articleContent", 200, 0);
        setTimeout(function(){
            $scope.baseController.initTinymce("#articleIntro", 350, 0);
            $scope.baseController.initTinymce("#articleFaculty", 350, 0);
            $scope.baseController.initTinymce(".articleProcedure", 200, 0);
            $scope.baseController.initTinymce("#articleForte", 350, 0);
        }, 300);


    }

    $scope.addProcedureCreate = function () {
        if ($scope.listProcedure.length > 0) {
            var idNew = $scope.listProcedure.slice(-1).pop().id + 1;
            $scope.listProcedure.push({id: idNew});
        } else {
            $scope.listProcedure.push({id: 1});
        }
        setTimeout(function(){
            $scope.baseController.initTinymce(".articleProcedure", 200, 0);
        }, 300);
    };

    $scope.removeProcedureCreate = function (procedure) {
        angular.forEach($scope.listProcedure, function (value, key) {
            if (value.id == procedure.id) {
                $scope.listProcedure.splice(key, 1);
            }
        });
        tinymce.remove();
        setTimeout(function(){
            $scope.baseController.initTinymce(".articleProcedure", 200, 0);
        }, 300);
    }

    $scope.reset = function () {
        $scope.filter = {
        }
        $scope.find();
    };
    
    $scope.createArticle = function () {
        if (!$scope.newArticle.title) {
            $('#newArticleTitle').focus();
            $('#newArticleTitle').css('border-color', 'red');
            return;
        } else {
            $('#newArticleTitle').css('border-color', '#d2d6de');
        }
        if (!$scope.newArticle.category_id) {
            $('#newArticleCategory').focus();
            $('#newArticleCategory').css('border-color', 'red');
            return;
        } else {
            $('#newArticleCategory').css('border-color', '#d2d6de');
        }
        if ($scope.newArticle.slug && hasWhiteSpace($scope.newArticle.slug)) {
            $('#newArticleSlug').focus();
            $('#newArticleSlug').css('border-color', 'red');
            return;
        } else {
            $('#newArticleSlug').css('border-color', '#d2d6de');
        }
        $('#createArticleButton').button('loading');
        var description = '';
        var intro = '';
        var faculty = '';
        var procedure = [];
        var forte = '';
        for (i=0; i < tinyMCE.editors.length; i++){
            if (tinyMCE.editors[i].id == 'articleContent') {
                description = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'articleIntro') {
                intro = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'articleFaculty') {
                faculty = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'articleForte') {
                forte = tinyMCE.editors[i].getContent();
            } else {
                procedure.push(tinyMCE.editors[i].getContent());
            }
        }
        var content = {
            intro: intro,
            faculty: faculty,
            procedure: procedure,
            forte: forte
        };
        var param = {
            api_token: api_token,
            title: $scope.newArticle.title,
            category_id: $scope.newArticle.category_id,
            description: description,
            order: $scope.newArticle.order,
            meta_description: $scope.newArticle.meta_description,
            meta_title: $scope.newArticle.meta_title,
            meta_keywords: $scope.newArticle.meta_keywords,
            status: $scope.newArticle.status,
            content: JSON.stringify(content),
            slug: $scope.newArticle.slug,
            image: $scope.newArticle.image,
            type: 'advance'
        };
        $http.post(api_domain + "/api/article/create", param).success(function (data) {
            if (data.status == 'successful') {
                showMessage('Successful!', 'Created successful!', 'success');
                $('#createArticleForm').modal('hide');
                $scope.newArticle = {};
                $scope.find();
            } else {
                showMessage('Error', data.message, 'error');
            }
            $('#createArticleButton').button('reset');
        });
    }

    $scope.showEditArticle = function(article){
        tinymce.remove();
        $scope.editArticle = angular.copy(article);
        var content = JSON.parse(article.content);
        $scope.editArticle.intro = content.intro;
        $scope.editArticle.faculty = content.faculty;
        // $scope.editArticle.procedure = content.procedure;
        $scope.editArticle.forte = content.forte;
        $scope.previewImg = $scope.editArticle.image;
        $('.edit-tab').removeClass('active');
        $('.edit-tab-active').addClass('active');
        $('#editArticleForm').modal('show');
        $scope.listProcedureEdit = [];
        if (content.procedure) {
            angular.forEach(content.procedure, function (value, key) {
                $scope.listProcedureEdit.push({id: key + 1, value: value});
            });
        }


        setTimeout(function(){
            $scope.baseController.initTinymce("#editArticleContent", 200, 0);
        }, 200);
        setTimeout(function(){
            $scope.baseController.initTinymce("#editArticleIntro", 350, 0);
            $scope.baseController.initTinymce("#editArticleFaculty", 350, 0);
            $scope.baseController.initTinymce(".editArticleProcedure", 350, 0);
            $scope.baseController.initTinymce("#editArticleForte", 350, 0);
        }, 300);

    }

    $scope.addProcedureEdit = function () {
        if ($scope.listProcedureEdit.length > 0) {
            var idNew = $scope.listProcedureEdit.slice(-1).pop().id + 1;
            $scope.listProcedureEdit.push({id: idNew, value: ''});
        } else {
            $scope.listProcedureEdit.push({id: 1, value: ''});
        }
        setTimeout(function(){
            $scope.baseController.initTinymce(".editArticleProcedure", 200, 0);
        }, 300);
    };

    $scope.removeProcedureEdit = function (procedure) {
        angular.forEach($scope.listProcedureEdit, function (value, key) {
            if (value.id == procedure.id) {
                $scope.listProcedureEdit.splice(key, 1);
            }
        });
        tinymce.remove();
        setTimeout(function(){
            $scope.baseController.initTinymce(".editArticleProcedure", 200, 0);
        }, 300);
    }
    $scope.updateArticle = function () {
        if (!$scope.editArticle.title) {
            $('#editArticleTitle').focus();
            $('#editArticleTitle').css('border-color', 'red');
            return;
        } else {
            $('#editArticleTitle').css('border-color', '#d2d6de');
        }
        if (!$scope.editArticle.category_id) {
            $('#editArticleCategory').focus();
            $('#editArticleCategory').css('border-color', 'red');
            return;
        } else {
            $('#editArticleCategory').css('border-color', '#d2d6de');
        }
        if ($scope.editArticle.slug && hasWhiteSpace($scope.editArticle.slug)) {
            $('#editArticleSlug').focus();
            $('#editArticleSlug').css('border-color', 'red');
            return;
        } else {
            $('#editArticleSlug').css('border-color', '#d2d6de');
        }
        $('#updateArticleButton').button('loading');
        var description = '';
        var intro = '';
        var faculty = '';
        var procedure = [];
        var forte = '';
        for (i=0; i < tinyMCE.editors.length; i++){
            if (tinyMCE.editors[i].id == 'editArticleContent') {
                description = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'editArticleIntro') {
                intro = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'editArticleFaculty') {
                faculty = tinyMCE.editors[i].getContent();
            } else if (tinyMCE.editors[i].id == 'editArticleForte') {
                forte = tinyMCE.editors[i].getContent();
            } else {
                procedure.push(tinyMCE.editors[i].getContent());
            }
        }
        var content = {
            intro: intro,
            faculty: faculty,
            procedure: procedure,
            forte: forte
        };
        var param = {
            id: $scope.editArticle.id,
            api_token: api_token,
            title: $scope.editArticle.title,
            category_id: $scope.editArticle.category_id,
            description: description,
            order: $scope.editArticle.order,
            meta_description: $scope.editArticle.meta_description,
            meta_title: $scope.editArticle.meta_title,
            meta_keywords: $scope.editArticle.meta_keywords,
            status: $scope.editArticle.status,
            image: $scope.editArticle.image,
            content: JSON.stringify(content),
            slug: $scope.editArticle.slug
        };
        $http.post(api_domain + "/api/article/update", param).success(function (data) {
            if (data.status == 'successful') {
                showMessage('Successful!', 'Update successful!', 'success');
                $('#editArticleForm').modal('hide');
                $scope.find();
            } else {
                showMessage('Error', data.message, 'error');
            }
            $('#updateArticleButton').button('reset');
        });
    }

    this.initialize();
    

    //fix enable input insert link, image in tinymce
    $(document).on('focusin', function(e) {
        if ($(e.target).closest(".mce-window").length || $(e.target).closest(".moxman-window").length) {
            e.stopImmediatePropagation();
        }
    });

    function hasWhiteSpace(string) {
        return string.indexOf(' ') >= 0;
    }

    $scope.deleteArticle = function (article) {
        if (!confirm("Bạn có chắc chắn xóa bài viết: " + JSON.stringify(article.title))) {
            return;
        }
        $http.post(api_domain + "/api/article/delete", {id: article.id, api_token: api_token}).success(function (data) {
            if (data.status != 'successful') {
                showMessage("Error", data.message, "error");
            } else {
                showMessage("Successful", "Delete param successful!", "success");
                $scope.find();
            }
        });
    };

    $scope.saveSortOrders = function (items) {
        var idSubmit = '#submit-order';
        $(idSubmit).button('loading');
        var param = {
            items: items,
            api_token: api_token
        };
        $http.post(api_domain + "/api/article/update-multi-order", param).success(function (data) {
            if (data.status == 'successful') {
                showMessage('Successful!', 'Update successful!', 'success');
                $scope.find();
            } else {
                showMessage('Error', data.message, 'error');
            }
            $(idSubmit).button('reset');
        });
    }

    $scope.upload = function (file, storeObj, type) {
        $('#saveButton').button('loading');
        var date = new Date();
        Upload.upload({
            url: api_domain + '/api/upload/images',
            data: {images: [file], api_token, path: '/upload/images/news/cover/' + date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate() + '/'}
        }).then(function (resp) {
            $scope.onUploadNewStoreLogoSuccess(resp, storeObj, type);
        }, function (resp) {
            // showMessage('Error', 'Can not upload this images', 'error');
            $('#saveButton').button('reset');
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
        });
    };

    $scope.onUploadNewStoreLogoSuccess = function (resp, storeObj, type) {
        if (type == 'banner') {
            storeObj.banner = resp.data[0];
            $scope.previewBanner = cdn_url  + storeObj.banner;
        } else {
            storeObj.image = resp.data[0];
            $scope.previewImg = storeObj.image;
        }
        $('#saveButton').button('reset');
    }
}
