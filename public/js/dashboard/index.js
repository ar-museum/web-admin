function countUp(count, $display)
{
    var div_by = 100,
        speed = Math.round(count / div_by),
        run_count = 1,
        int_speed = 24;

    var int = setInterval(function() {
        if(run_count < div_by){
            $display.text(speed * run_count);
            run_count++;
        } else if(parseInt($display.text()) < count) {
            var curr_count = parseInt($display.text()) + 1;
            $display.text(curr_count);
        } else {
            clearInterval(int);
        }
    }, int_speed);
}

$(function() {
    $('.state-overview').find('h1').each(function() {
        var _count = parseInt($(this).text());

        if (_count == 0)
        {
            return;
        }

        countUp(_count, $(this));

        if ($(this).text().length >= 5)
        {
            $(this).css({
                'font-size': '30px',
                'margin-top': '6px'
            });
        }
    });
});