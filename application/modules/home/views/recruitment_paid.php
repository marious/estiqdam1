<div class="container">
    <div class="col-md-3 visible-sm visible-lg visible-md">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
    <div class="col-md-9">

        <div class="col-md-12 building-container">
            <article>
                <h1 class="page-header center">أسعار مكاتب الاستقدام</h1>
                <p>نقدم خدمة البحث عن أسعار مكاتب الاستقدام لاستقدام العمالة المنزلية والاسعار محدثة طبقا لبرنامج العمالة المنزلية (مساند)</p>
                <br><br>
                <div>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="exampleInputName2">المنطقة </label>
                            </div>
                           <div class="col-sm-10">
                               <select class="form-control" id="edit-region" name="region">
                                   <option value="0">المنطقة</option>
                                   <option value="1">الحدود الشمالية</option>
                                   <option value="2">الجوف</option>
                                   <option value="3">تبوك</option>
                                   <option value="4">حائل</option>
                                   <option value="5">القصيم</option>
                                   <option value="6">الرياض</option>
                                   <option value="7">المدينة المنورة</option>
                                   <option value="8">عسير</option>
                                   <option value="9">الباحة</option>
                                   <option value="10">جازان</option>
                                   <option value="11">مكة المكرمة</option>
                                   <option value="12">نجران</option>
                                   <option value="13">الشرقية</option>
                               </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="exampleInputEmail2">الجنسية</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="form-control" id="edit-nationality" name="nationality">
                                    <option value="0">الجنسية</option>
                                    <option value="1">السودان</option>
                                    <option value="2">الفلبين</option>
                                    <option value="3">النيجر</option>
                                    <option value="4">الهند</option>
                                    <option value="5">اليمن</option>
                                    <option value="6">باكستان</option>
                                    <option value="7">بنجلاديش</option>
                                    <option value="8">تنزانيا</option>
                                    <option value="9">سريلانكا</option>
                                    <option value="10">فيتنام</option>
                                    <option value="11">مصر</option>
                                    <option value="28">ارتيريا</option>
                                    <option value="37">بيرو</option>
                                    <option value="41">مدغشقر</option>
                                    <option value="47">مدغشقر</option>
                                    <option value="71">كمبوديا</option>
                                    <option value="78">بورندي</option>
                                    <option value="79">نيجيريا</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sm-push-4">
                            <button type="submit" class="btn btn-primary btn-block" id="search-recruitment-paid">بحث</button>
                        </div>
                    </form>
                </div>


                <div class="recruiment-content">
                </div>


            </article>


            <hr>

            <div class="col-md-6 col-md-push-2">
                <div class="contact-us">
                    <a href="tel:0541566633" title="0541566633"> <i class="fa fa-mobile"></i> 0541566633</a>
                    <a href="tel:0547830004" title="0547830004"> <i class="fa fa-mobile"></i> 0547830004</a>
                </div>
                <div class="share-buttons">
                    <a href="https://api.whatsapp.com/send?phone=966541566633" class="btn btn-block whatsapp-share" target="_blank">تواصل واتس <i class="fa fa-whatsapp white"></i></a>
                </div>
            </div>
        </div>


    </div>
    <div class="col-md-3 visible-xs">
        <?php $this->load->view('_includes/sidebar'); ?>
    </div>
</div>