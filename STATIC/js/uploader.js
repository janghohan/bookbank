let UploaderItem = {
    timer: 300,
    $input: null,
    $wrap : null,
    $target : null,
    $btn : null,
    sel_files : [],
    init: function (target) {
    	this.$wrap = $('.uploader');
        this.$target = $('.files');
        this.$input = $(target);
        
    	this.$input.val('');
        this.$target.html("");
        this.sel_files = [];
    },
    loader : function(file){
    	this.sel_files.push(file); // 데이터 추가
	    this.create(file);
    },
    create : function(file){
    	var reader = new FileReader();
    	var item, close, img;
    	var that = this;
    	reader.onload = function(e){
	    	item = document.createElement("div");
	    	close = document.createElement("input");
	    	img = document.createElement("div");

	    	item.setAttribute("class","item");
	    	close.setAttribute("class","close");
	    	close.setAttribute("type","button");
	    	close.setAttribute('delFile', file.name);
	    	img.innerHTML = file.name;
	    	item.appendChild(img);
	    	item.appendChild(close);
	    	that.append(item);
	    }
	    reader.readAsDataURL(file);
    },
    append : function(dom){
    	var that = this;

    	this.$target.append(dom);
    	this.$btn = this.$target.find('.close');

    	this.$btn.on('click', function(e){
    		that.delete(this);
    	});
    },
    delete : function(btn){
    	var that = this;
    	var btn = $(btn);
        var delFile = btn.attr('delFile');
        for(var i=0 ; i < that.sel_files.length; i++){
        	if(delFile == that.sel_files[i].name){
       			that.sel_files.splice(i, 1);   
                that.$target.find('.item').eq(i).remove();
        	}
        }
        that.$input.val("");
        that.$input.trigger('change');
    },
};

function MultipleUploader(target){
    this.$target = null, // item
    MultipleUploader.prototype.init = function(target){
        UploaderItem.init(target);
        this.$target = $(target);
    }
    MultipleUploader.prototype.initEvent = function(e){
        var that = this;
		// upload
        this.$target.on('change', function(e){
        	that.upload(e);
        });
    }
    MultipleUploader.prototype.upload = function(e){
    	var files = e.target.files;
	    var fileArr = Array.prototype.slice.call(files)
	    for(f of fileArr){
	      UploaderItem.loader(f);
	    }
    }
    this.init(target);
    this.initEvent();
}

function ImageMultipleUploader(target){
    this.$wrap = null,
    this.$target = null, // item
    this.$imgArea = null,
    this.$btn = null,
    this.maxleng = null,
    this.sel_files = [],
    ImageMultipleUploader.prototype.init = function(target){
        this.$target = $(target);
        this.$wrap = this.$target.parents('.uploader_area');
        this.$imgArea = this.$wrap.find('.uploadList');
        this.maxleng = this.$target.attr('maxlength');
    }


    ImageMultipleUploader.prototype.initEvent = function(e){
        var that = this;
        // upload
        this.$target.on('change', function(e){
            that.upload(e);
        });
    }
    ImageMultipleUploader.prototype.create = function(file){
        this.sel_files.push(file);

        var reader = new FileReader();
        var item, close, img;
        var that = this;
        reader.onload = function(e){
            item = document.createElement("div");
            close = document.createElement("input");
            img = document.createElement("img");

            item.setAttribute("class","item");
            close.setAttribute("class","close");
            close.setAttribute("type","button");
            close.setAttribute('delFile', file.name);
            img.src = e.target.result;

            item.appendChild(img);
            item.appendChild(close);
            that.append(item);
        }
        reader.readAsDataURL(file);
    }
    ImageMultipleUploader.prototype.append = function(dom){
        var upload = this.$target.parent();
        var leng = this.$imgArea.find('.item').length;
        if(this.maxleng > leng){
            this.$imgArea.append(dom);
            upload.hide();

            this.$btn = this.$imgArea.find('.close');

            var that = this;
            this.$btn.on('click', function(e){
                that.delete(this);
                upload.show();
            });
        } 
    }
    ImageMultipleUploader.prototype.delete = function(btn){
        var that = this;
        var btn = $(btn);
        var delFile = btn.attr('delFile');
        for(var i=0 ; i < that.sel_files.length; i++){
            if(delFile == that.sel_files[i].name){
                that.sel_files.splice(i, 1);   
                btn.parents('.item').remove();
            }
        }
        that.$target.val("");
        that.$target.trigger('change');
    }
    ImageMultipleUploader.prototype.upload = function(e){
        var that = this;
        var files = e.target.files;
        var fileArr = Array.prototype.slice.call(files);
        var item = null;
        for(f of fileArr){
            that.create(f);
        }
    }
    this.init(target);
    this.initEvent();
}