@extends( $__theme . '.layouts.default')

{{-- Page Header --}}
@section('page_header')
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url('/uploads/defaults/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1>Веб-мастер</h1>
                    <hr class="small">
                    <span class="subheading">Тема для Веб-сайта</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

{{-- Content section --}}
@section('content')
  <section class="sup-header">
      <div class="container">
          <div class="row">
              <div class="col-md-4">
                  <h1><i class="fa fa-pencil"></i> Контакти</h1>
              </div>
          </div>
      </div>
  </section>

  <section class="content smaller-margin">
      <div class="container">
          <div class="map">
              <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2667.469945459257!2d30.85061862789395!3d48.043263355823534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDjCsDAyJzMwLjkiTiAzMMKwNTEnMDUuMSJF!5e0!3m2!1sru!2sua!4v1460381023808"
                  width="100%"
                  height="351"
                  frameborder="0"
                  scrolling="no"
                  marginheight="0"
                  marginwidth="0">
              </iframe>
          </div>
          <div class="contacts-wrap">
              <h1>Ви можете задати своє питання або відправити нам пропозицію <br> скориставшись контактною формою</h1>
              <div class="row">
                  <div class="col-md-6 col-lg-7">
                      <div class="info">
                        {{ (! function_exists('getAdminContact') ? getAdminContact() : '' ) }}
                          <!-- <i class="fa fa-map-marker"></i> Україна, м. Первомайськ, Миколаївська область, <br> вул. Шевченка 15, № офіса 3<br>
                          <i class="fa fa-envelope-o"></i> <a href="mailto:office@tochka-vidliku.mk.ua">office@tochka-vidliku.mk.ua</a><br>
                          <i class="fa fa-skype"></i> tochka-vidliku<br>
                          <i class="fa fa-mobile"></i> (050) 391 65 90<br>
                          <i class="fa fa-mobile"></i> (067) 420 60 40 -->
                      </div>

                      {{--
                      <h2>Приєднуйтесь</h2>

                      <div class="sosial-links">
                          <a href=""><i class="fa fa-odnoklassniki"></i></a>
                          <a href=""><i class="fa fa-facebook"></i></a>
                          <a href=""><i class="fa fa-vk"></i></a>
                          <a href=""><i class="fa fa-twitter"></i></a>
                      </div>
                      --}}
                  </div>
                  <div class="col-md-6 col-lg-5">
                      <div class="form-holder contacts-form-holder">
                          <form class="form-horizontal content-form">
                              <h2>Ми будемо раді Вашему повідемленню</h2>
                              <div class="form-group">
                                  <label for="name" class="col-sm-3 control-label">Ваше ім’я<span class="require">*</span>:</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control input-sm" name="name" id="name">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="email" class="col-sm-3 control-label">Ваш e-mail<span class="require">*</span>:</label>
                                  <div class="col-sm-9">
                                      <input type="email" class="form-control input-sm" name="email" id="email">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="subject" class="col-sm-3 control-label">Тема:</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control input-sm" name="subject" id="subject">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-12">
                                      <textarea class="form-control input-sm" rows="5" name="msg" placeholder="Текст повідомлення"></textarea>
                                  </div>
                              </div>
                              <div class="form-group text-right">
                                <!-- Captcha -->
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-7"><span class="require">Поля, позначені зірочкою*,<br> обов’язкові до заповнення</span></div>
                                  <div class="col-sm-5">
                                    <button type="submit" class="btn btn-block btn-default btn-default-border">надіслати</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection