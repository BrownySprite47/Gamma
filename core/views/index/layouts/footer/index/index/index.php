    <footer id="footer" class="footer">
        <div class="footer-bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 mobile"><a href="/index/about">О проекте</a></div>
                    <div class="col-lg-4 mobile"><a href="/index/confidential">Политика конфиденциальности</a></div>
                    <div class="col-lg-4 mobile"><a class="mail" href="">hello@company.com</a><span>© Gamma. Все права защищены</span></div>
                </div>
            </div>
        </div>
    </footer>


    <script src="/assets/libs/bootstrap/bootstrap.min.js"></script>
    <script src="/assets/libs/bootstrap/bootstrap-select.js"></script>
    <script src="/assets/libs/bootstrap/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/index/js/common/index/script.js"></script>

    <?php if (isset($data['js'])): ?>
      <?php foreach ($data['js'] as $js): ?>
          <script src="/assets/<?=$js?>"></script>
      <?php endforeach; ?>
    <?php endif; ?>
    <script>
        $('.selectpicker').selectpicker('refresh');
        $('.selectpicker').selectpicker({ size: 8 });
        $(window).on('load', function () {
            var $preloader = $('#page-preloader'),
                $spinner   = $preloader.find('.spinner');
            $spinner.fadeOut();
            $preloader.delay(50).fadeOut('slow');
        });
    </script>
    </body>
</html>


