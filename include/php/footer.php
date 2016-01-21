    <div class="container">
        <!-- Begin footer -->
        <div id="footer-nav" class="flex-container">
            <div class="flex-expand"><a href="#">Προσωπικό</a></div>
            <div>|</div>
            <div class="flex-expand"><a href="#">Χάρτης σελίδας</a></div>
            <div>|</div>
            <div class="flex-expand"><a href="#">Κανονισμός λειτουργίας</a></div>
            <div>|</div>
            <div class="flex-expand"><a href="#">Προσβασιμότητα</a></div>
            <div>|</div>
            <div class="flex-expand"><a href="#">Πανεπιστήμιο Αθηνών</a></div>
        </div>
        <!-- End footer -->
    </div>
    <script>
    $(document).ready(function() {
        var docHeight = $(window).height();
        var footerHeight = $('#footer-nav').outerHeight();
        var footerTop = $('#footer-nav').position().top + footerHeight;

        if (footerTop < docHeight) {
            $('#footer-nav').css('margin-top', 10+ (docHeight - footerTop) + 'px');
        }
    });
    </script>
</body>
</html>
