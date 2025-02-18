!function (a) {
    "use strict";
    a.fn.spartanMultiImagePicker = function (i) {
        var e = 0, t = 0, n = 0, d = {
            fieldName: "",
            groupClassName: "col-md-4 col-sm-4 col-xs-6",
            rowHeight: "200px",
            dropFileLabel: "Drop file here",
            placeholderImage: {
                image: "data:image/png;base64,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",
                width: "64px"
            },
            maxCount: "",
            maxFileSize: "",
            allowedExt: "png|jpg|jpeg|gif",
            onAddRow: function () {
            },
            onRenderedPreview: function () {
            },
            onRemoveRow: function () {
            },
            onExtensionErr: function () {
            },
            onSizeErr: function () {
            },
            directUpload: {
                loaderIcon: '<i class="fa fa-sync fa-spin"></i>', status: !1, url: "", success: function () {
                }, error: function () {
                }
            }
        }, r = a.extend({}, d, i);

        function o(i, n) {
            t = e;
            var d = i.groupClassName, r = i.rowHeight, o = i.fieldName, s = i.placeholderImage, l = i.dropFileLabel,
                p = s.image, A = "64px", c = '<i class="fa fa-sync fa-spin"></i>';
            void 0 !== i.directUpload.loaderIcon && (c = i.directUpload.loaderIcon), void 0 !== s.width && (A = s.width);
            var g = `<div class="${d} spartan_item_wrapper" data-spartanindexrow="${e}" style="margin-bottom : 20px; ">` + '<div style="position: relative;">' + `<div class="spartan_item_loader" data-spartanindexloader="${e}" style=" position: absolute; width: 100%; height: ${r}; background: rgba(255,255,255, 0.7); z-index: 22; text-align: center; align-items: center; margin: auto; justify-content: center; flex-direction: column; display : none; font-size : 1.7em; color: #CECECE">` + `${c}` + "</div>" + `<label class="file_upload" style="width: 150px; height: auto; border: 2px dashed #ddd; border-radius: 3px; cursor: pointer; text-align: center; overflow: hidden; padding: 5px; margin-top: 5px; margin-bottom : 5px; position : relative; align-items: center; margin: auto; justify-content: center; flex-direction: column;">` + `<a href="javascript:void(0)" data-spartanindexremove="${e}" style="position: absolute !important; right : 3px; top: 3px; display : none; background : #ED3C20; border-radius: 3px; width: 30px; height: 30px; line-height : 30px; text-align: center; text-decoration : none; color : #FFF;" class="spartan_remove_row"><i class="fa fa-times"></i></a>` + `<img style="width: ${A}; margin: 0 auto; vertical-align: middle;" data-spartanindexi="${e}" src="${p}" class="spartan_image_placeholder" /> ` + `<p data-spartanlbldropfile="${e}" style="color : #5FAAE1; display: none; width : auto; ">${l}</p>` + `<img style="width: 100%; vertical-align: middle; display:none;" class="img_" data-spartanindeximage="${e}">` + `<input class="form-control spartan_image_input" accept="image/*" data-spartanindexinput="${e}" style="display : none"  name="${o}" type="file">` + "</label> </div></div>",
                f = a.parseHTML(g);
            a(n).append(f);
            ++e;
            i.onAddRow.call(this, e)
        }

        function s(i, t, d) {
            var r = a(t).data("spartanindexinput");
            if (t.files && t.files[0]) {
                var s = t.files[0], l = i.allowedExt, p = i.maxFileSize, A = s.type;
                if (!new RegExp(`(.*?).(${l})$`).test(A) && "" != l) return 1 == a(d).find('img[data-spartanindeximage="' + r + '"]').is(":visible") && a(d).find('img[data-spartanindexi="' + r + '"]').hide(), i.onExtensionErr.call(this, r, s), !1;
                if ("" == p || "" != p && s.size <= p) {
                    var c = new FileReader;
                    c.onload = function (e) {
                        a(d).find('img[data-spartanindexi="' + r + '"]').hide(), a(d).find('a[data-spartanindexremove="' + r + '"]').show(), a(d).find('img[data-spartanindeximage="' + r + '"]').attr("src", e.target.result), a(d).find('img[data-spartanindeximage="' + r + '"]').show(), i.onRenderedPreview.call(this, r), 1 == i.directUpload.status && function (i, e, t) {
                            var n = a(e).data("spartanindexinput"), d = new FormData, r = e.files[0],
                                o = i.directUpload.additionalParam;
                            a(t).find('[data-spartanindexloader="' + n + '"]').css("display", "flex"), d.append("file", r), void 0 !== o && a.each(o, function (a, i) {
                                d.append(a, i)
                            });
                            a.ajax({
                                url: i.directUpload.url,
                                type: "POST",
                                data: d,
                                cache: !1,
                                processData: !1,
                                contentType: !1,
                                success: function (e, d, r) {
                                    a(t).find('[data-spartanindexloader="' + n + '"]').css("display", "none"), void 0 !== i.directUpload.success && i.directUpload.success(this, e, d, r)
                                },
                                error: function (e, d, r) {
                                    a(t).find('[data-spartanindexloader="' + n + '"]').css("display", "none"), void 0 !== i.directUpload.error && i.directUpload.error(this, e, d, r)
                                }
                            })
                        }(i, t, d)
                    }, c.readAsDataURL(t.files[0]);
                    var g = !1;
                    0 == a(d).find('img[data-spartanindeximage="' + r + '"]').is(":visible") && (n++, g = !0), r == e - 1 && g && ("" == i.maxCount ? o(i, d) : "" != i.maxCount && n < i.maxCount && o(i, d))
                } else if ("" != p && s.size > p) return 1 == a(d).find('img[data-spartanindeximage="' + r + '"]').is(":visible") && a(d).find('img[data-spartanindexi="' + r + '"]').hide(), i.onSizeErr.call(this, r, s), !1
            }
        }

        return this.each(function () {
            var i = this;
            o(r, i), a(this).on("change", ".spartan_image_input", function () {
                s(r, this, i)
            }), a(this).on("click", ".spartan_remove_row", function () {
                !function (i, e, d) {
                    var r = a(e).data("spartanindexremove");
                    a(d).find('[data-spartanindexrow="' + r + '"]').remove(), t != r && 1 != a(d).find('img[data-spartanindeximage="' + t + '"]').is(":visible") || o(i, d), n--, i.onRemoveRow.call(this, r)
                }(r, this, i)
            }), a(this).on("dragenter dragover dragstart", ".spartan_item_wrapper", function (i) {
                var e, t;
                i.stopPropagation(), i.preventDefault(), t = a(e = this).data("spartanindexrow"), a(e).find(".file_upload").css({
                    "border-color": "#5FAAE1",
                    background: "#DBE9F3"
                }), 0 == a(e).find('img[data-spartanindeximage="' + t + '"]').is(":visible") && (a(e).find('p[data-spartanlbldropfile="' + t + '"]').show(), a(e).find('img[data-spartanindexi="' + t + '"]').hide())
            }), a(this).on("dragleave", ".spartan_item_wrapper", function () {
                var i, e;
                e = a(i = this).data("spartanindexrow"), a(i).find(".file_upload").css({
                    "border-color": "#ddd",
                    background: "none"
                }), 0 == a(i).find('img[data-spartanindeximage="' + e + '"]').is(":visible") && (a(i).find('p[data-spartanlbldropfile="' + e + '"]').hide(), a(i).find('img[data-spartanindexi="' + e + '"]').show())
            }), a(this).on("drop", ".spartan_item_wrapper", function (e) {
                var t, n, d, o, l;
                e.stopPropagation(), e.preventDefault(), n = i, d = e, o = a(t = this).data("spartanindexrow"), (l = a(n).find('.spartan_image_input[data-spartanindexinput="' + o + '"]')).files = d.originalEvent.dataTransfer.files, a(t).find(".file_upload").css({
                    "border-color": "#ddd",
                    background: "none"
                }), a(t).find('p[data-spartanlbldropfile="' + o + '"]').hide(), a(t).find('img[data-spartanindexi="' + o + '"]').show(), s(r, l, n)
            })
        })
    }
}(jQuery);
