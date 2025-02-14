<!-- Start Footer -->
<footer class="footer-section">
    <div class="pattern">
        <img src="{{ asset('assets') }}/frontend/images/bg/footer.svg" class="img-contain" />
    </div>
    <div class="container">
        <div class="footer">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-12">
                    <div class="footer-logo">
                        <img src="{{ asset('assets') }}/frontend/images/logo.svg" alt="logo" class="img-contain" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4 col-12">
                    <div class="footer-info">
                        <h3 class="footer-title">عن كفالات</h3>
                        <p class="footer-desc">
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم
                            توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا
                            النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                            التى يولدها التطبيق. إذا كنت تحتاج إلى عدد أكبر من الفقرات
                        </p>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-5">
                    <div class="footer-menu">
                        <h3 class="footer-title">روابط مهمة</h3>
                        <ul class="footer-list">
                            <li><a href="#!"> تواصل معنا </a></li>
                            <li><a href="{{ route('project.index') }}"> المشاريع </a></li>
                            {{-- <li><a href="#!"> مجالات الكفالة </a></li> --}}
                            <li><a href="{{ route('news.index') }}"> أخبار كفالات </a></li>
                            <li><a href="#!"> الأسئلة الشائعة </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4 col-7">
                    <div class="footer-menu">
                        <h3 class="footer-title">تواصل معنا</h3>
                        <ul class="footer-contacts">
                            <li>
                                <a href="#!" target="_blank">
                                    <i class="las la-globe"></i>
                                    <span
                                        class="en">{{ app('settings')->find('site-link', 'www.kfalat.com') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{ app('settings')->find('site-email', 'contact@kfalat.net') }}">
                                    <i class="las la-envelope"></i>
                                    <span
                                        class="en">{{ app('settings')->find('site-email', 'contact@kfalat.net') }}</span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ app('settings')->find('site-phone', '+9660505426859') }}">
                                    <i class="las la-phone"></i>
                                    <span
                                        class="en">{{ app('settings')->find('site-phone', '+9660505426859') }}</span>
                                </a>
                            </li>
                            <li>
                                <span>
                                    <i class="las la-map-marker-alt"></i>
                                    {{ app('settings')->find('site-address', 'الرياض - المملكة العربية السعودية') }}
                                </span>
                                <!-- <a href="#!" target="_blank">
                    <i class="las la-map-marker-alt"></i>
                    الرياض - المملكة العربية السعودية
                  </a> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->
