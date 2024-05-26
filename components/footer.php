<footer class="container bg-dark text-white">
    <div class="row">
        <?php
        $footerData = json_decode(file_get_contents('jsons/footerdata.json'), true);

        function renderColumn($title, $content)
        {
            echo '<div class="col-25">';
            echo '<h4>' . $title . '</h4>';
            echo $content;
            echo '</div>';
        }

        // Who We Are
        renderColumn($footerData['whoWeAre']['title'], '<p>' . $footerData['whoWeAre']['description'] . '</p>');

        // Contact Us
        renderColumn($footerData['contactUs']['title'], '<p><i class="fa fa-envelope" aria-hidden="true"><a href="mailto:' . $footerData['contactUs']['email'] . '">' . $footerData['contactUs']['email'] . '</a></i></p>' .
            '<p><i class="fa fa-phone" aria-hidden="true"><a href="tel:' . $footerData['contactUs']['phone'] . '">' . $footerData['contactUs']['phone'] . '</a></i></p>');

        // Fast Menu
        renderColumn($footerData['fastMenu']['title'], implode('', array_map(function ($link) {
            return '<p><a href="' . $link['url'] . '">' . $link['text'] . '</a></p>';
        }, $footerData['fastMenu']['links'])));

        // Where We Are Located
        renderColumn($footerData['whereWeAreLocated']['title'], '<iframe src="' . $footerData['whereWeAreLocated']['mapSrc'] . '" width="300" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>');

        ?>
    </div>
    <div class="row">
        <?php echo $footerData['creator']; ?>
    </div>
</footer>
