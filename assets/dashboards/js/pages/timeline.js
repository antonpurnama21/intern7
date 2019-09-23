$(function() {
      $.ajax({
        type:'POST',
        url: $('#getTimeline').val(),
        dataType:"JSON",
        success: function(data) {
              $('#calendar').fullCalendar({

              plugins: [ 'interaction', 'dayGrid' ],
              header: {
                right: 'prev,next'
              },

              eventRender: function(eventObj, el) {
              $(el).popover({
                  title: eventObj.title,
                  content: eventObj.description,
                  trigger: 'hover',
                  placement: 'top',
                  container: 'body'
                });
              },

              editable: false,
              businessHours: true,
              eventLimit: false,
              events: data,

              // eventRender: function(event, element) {
              //     element.attr('title', event.description);
              // }

            });
        },
        error:function(){
            $('#calendar').fullCalendar({

              plugins: [ 'interaction', 'dayGrid' ],
              header: {
                right: 'prev,next'
              },

              editable: false,
              businessHours: true,
              eventLimit: false,
              events:[]
            });
        }
    });


});
