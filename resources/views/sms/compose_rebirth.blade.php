@extends('layouts.dashboard.rebirth.app')
@section('title', 'dashboard')
@section('content')
     <div class="mx-auto">
          <div
            class="mb-6 bg-white shadow-lg rounded-lg p-4 tabletmd:p-8 sm:p-6">
            <h1 class="heading-2">Create New SMS</h1>
            <p class="text-sm text-gray-500 mt-1 flex items-center space-x-2">
              <span class="font-normal text-skzdark-200">Dashboard</span>
              <span>-</span>
              <a
                href="#"
                class="text-[#FFCB00] rounded-full text-sm font-medium"
                >SMS</a
              >
            </p>
          </div>

          <div class="bg-white shadow-lg rounded-lg p-4 tabletmd:p-8 sm:p-6">
            <div class="mb-6">
              <h2 class="heading-3">Type Message</h2>
              <p class="text-sm text-gray-500 mt-1">
                Your message is saved automatically as you type
              </p>
            </div>

            <div class="space-y-6 mb-8">
              <div>
                <label
                  for="title"
                  class="block text-gray-600 font-normal mb-2"
                >Message Title</label
                >
                <input
                  type="text"
                  id="title"
                  placeholder="Input message title"
                  class="tabletlg:w-9/12 w-full border border-gray-300 rounded-lg p-3 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors l compulsory-field" 
                   value="{{ $message->title }}"
                />
                <p class="text-danger" style="display: none;">This Field is Required</p>
              </div>

              <div class="tabletlg:w-11/12 w-full">
                <div class="flex items-center justify-between mb-2">
                  <label
                    for="message-content"
                    class="block text-gray-600 font-normal"
                    >Message Content</label
                  >
                  {{-- <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">AI Compose</span>
                    <label
                      class="relative inline-flex items-center cursor-pointer">
                      <input
                        type="checkbox"
                        value=""
                        class="sr-only peer"
                        id="ai-compose-toggle" />
                      <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-gray-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FFCB00]"></div>
                    </label>
                  </div> --}}
                </div>

                <div id="ai-prompt-container" class="hidden mt-4">
                  <div class="w-full justify-between items-center flex mb-4">
                    <label
                      for="ai-prompt"
                      class="block text-gray-600 font-normal mb-2"
                      >AI Prompt</label
                    >
                    <button
                      class="bg-[#FFCB00] text-skzdark-200 text-base px-4 tabletlg:w-2/12 w-3/12 h-12 rounded-lg hover:opacity-80 transition-colors cursor-pointer font-medium text-center">
                      Compose
                    </button>
                  </div>

                  <div class="relative">
                    <textarea
                      id="ai-prompt"
                      placeholder="Provide a few keywords or a short sentence to auto-compose the message..."
                      rows="3"
                      class="w-full border border-gray-300 focus:ring-1 rounded-lg p-3 focus:ring-[#FFCB00] focus:border-none outline-none transition-colors resize-none"></textarea>
                  </div>
                </div>

                <div class="relative">
                  <textarea
                    id="message-content"
                    placeholder="Start typing..."
                    rows="6"
                    value="{{ $message->content }}"
                    class="w-full border border-gray-300 rounded-lg p-3 pr-28 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors resize-none compulsory-field">{{ $message->content }}</textarea>
                    <p class="text-danger" style="display: none;">This Field is Required</p>
					          <input type="hidden" id="message-slug" value="{{ $message->slug }}">
                </div>
                <div class="text-end">
                    <small class="form-text text-grey-500"><span id="char-count">0</span> characters (<span id="page-count">1</span> page).</small>
                </div>
              </div>
              <div>
                <label
                  for="add-contact"
                  class="block text-gray-600 font-normal mb-2"
                  >Add numbers</label
                >
                <div
                  class="flex flex-col sm:flex-row tabletlg:flex-nowrap flex-wrap tabletsm:gap-y-4 gap-y-2 items-stretch sm:items-center space-y-3 sm:space-y-0 sm:space-x-3">
                  <div
                    id="tag-input-container"
                    class="flex flex-wrap items-center border border-gray-300 rounded-lg p-2 focus-within:ring-[#FFCB00] focus-within:border-[#FFCB00] outline-none transition-colors tabletlg:w-8/12 w-full">
                    <div
                      id="tags-wrapper"
                      class="flex  items-center overflow-x-auto"></div>
                    <input
                      type="text"
                      id="tag-input"
                      {{-- name="contact_input" --}}
                      placeholder="Type a phone number and press enter, space, or comma to add it"
                      class="w-full p-1 outline-none bg-transparent compulsory-field "
                      onpaste="handlePaste(event)"
                      {{-- onchange="handleTagInput()" --}}
                    />
                  </div>
                  <input type="hidden" id="contact-input" name="contact_input" class="manual_input">

                  <button
                    class="import-contact-button flex items-center justify-center space-x-2 bg-gray-100 border border-gray-300 text-gray-700 laptopmd:p-3 p-2 h-12 rounded-lg hover:bg-gray-200 transition-colors">
                    <span class="laptopmd:text-base text-sm"
                      >Import Existing Contacts</span
                    >
                    <span class="fa fa-contact-book"></span>
                  </button>
                  <input type="hidden" id="send-option" name="send-option" value="">
                </div>
              </div>
              <div
                id="schedule-fields"
                class="grid grid-cols-1 sm:grid-cols-2 gap-6 hidden">
                <div>
                  <label
                    for="select-date"
                    class="block text-gray-600 font-normal mb-2"
                    >Select Date</label
                  >
                  <div>
                    <input
                      type="date"
                      id="select-date"
                      class="w-full border border-gray-300 rounded-lg p-3 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors" />
                  </div>
                </div>
                <div>
                  <label
                    for="select-time"
                    class="block text-gray-600 font-normal mb-2"
                    >Select Time</label
                  >
                  <div>
                    <div>
                      <input
                        type="time"
                        id="select-time"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-[#FFCB00] focus:border-[#FFCB00] outline-none transition-colors" />
                    </div>
                  </div>
                </div>
              </div>

              <div
                class="flex flex-wrap mobilelg:flex-nowrap flex-row items-center tabletsm:justify-start justify-center space-y-4 sm:space-y-0 tabletmd:space-x-4 space-x-2 mt-6">
                <button
                   id="send-now"
                  class="bg-[#FFCB00] text-skzdark-200 text-base sm:px-4 px-2 laptopmd:w-2/12 sm:w-4/12 mobilelg:w-3/12 mobilemd:w-5/12 mobilesm:w-5/12 w-full h-12 rounded-lg hover:opacity-80 transition-colors cursor-pointer font-medium"
                >
                  Send Now
                </button>
                <button
                  id="send-later-button"
                  class="bg-transparent text-skzdark-200 text-base sm:px-4 px-2 laptopmd:w-2/12 sm:w-4/12 mobilelg:w-3/12 mobilemd:w-5/12 mobilesm:w-5/12 w-full h-12 rounded-lg hover:opacity-80 transition-colors cursor-pointer font-medium border border-skzdark-200">
                  Send Later
                </button>
                <button
                  class="bg-transparent text-skzdark-200 text-base sm:px-4 px-2 laptopmd:w-2/12 sm:w-4/12 mobilelg:w-3/12 mobilemd:w-5/12 mobilesm:w-5/12 w-full h-12 rounded-lg hover:opacity-80 transition-colors cursor-pointer font-medium border border-skzdark-200"
                  onclick="location.replace('{{ route('draft') }}')"
                >
                  Save to Draft
                </button>
              </div>
            </div>
          </div>
        </div>

        <script>
		
          setInterval(() => {
            saveMessage()
          }, 10000);

          function saveMessage(){
            
            let $this =$('#message-content')

            let msgSlug = $('#message-slug').val();

            let content = $this.val();
            let title = $('#title').val();
            if(content.length > 0 && title.length > 0){
              $.ajax({
                type: 'POST',
                url: "{{ route('save-message') }}",
                data: {
                  title: title,
                  content: content,
                  slug: msgSlug,
                  _token: universal_token
                },
                success:function(resonse){
                  console.log('saved')
                }
              });
            }
            
          }


          $(document).ready(function(){
            @isset($contactArr)
              var contactArr = <?= json_encode($contactArr) ?>;
            @else
              var contactArr = {};
            @endisset
            
            // when the send no button is clicked

            $('#send-now').on('click', function(){
              let oldHtml = $(this).html();
              let $this = $(this);
              $this.html('<i class="fa fa-spin fa-spinner"></i>')
              let option = $('#send-option').val();
              let msgContent = $('#message-content').val();
              let msgTitle = $('#title').val();
              if(msgTitle==''){
                validate('#title');
                $this.html(oldHtml)
                return;
              }
              if(msgContent==''){
                validate('#message-content');
                $this.html(oldHtml)
                return;
              }
              
              if (option==null) {
                validate('#send-option');
                $this.html(oldHtml)
                return;
                
              }
              let target = $('.'+option);
              // console.log(target
              if (target.val()=='') {
                validate('.'+option);
                $this.html(oldHtml)
                return
              }else{

                let msgSlug = $('#message-slug').val();
                // if sending to manually inputted contact
                if (option=='manual_input') {
                  let numbers = $('#contact-input').val();
                  let numSplit = numbers.split(',');

                  let availableUnits = parseFloat("{{ Auth::user()->units->sum('available_units') }}")
                  let requiredUnits = parseFloat(numSplit.length) * parseFloat(pcount);
                  let capacity = availableUnits/parseFloat(pcount);
                  if (requiredUnits > availableUnits) {
                    
                    swal({
                        title: 'Insufficient Units?',
                        text: "You only have "+availableUnits+" units but your message requires at least "+requiredUnits+" units to deliver to all numbers. If you want to continue, click proceed and we shall send your message to first "+Math.trunc(capacity)+" numbers only.",
                        icon: 'warning',
                        buttons: true,
                        // confirmButtonClass: 'btn btn-success',
                        // cancelButtonClass: 'btn btn-danger',
                        // confirmButtonText: 'Yes, delete it!',

                    }).then((proceed)=>{
                      if (proceed) {
                        sendMessage(msgSlug, numbers, 'numbers')
                      }
                    })
                    $this.html(oldHtml)
                  }else{

                    sendMessage(msgSlug, numbers, 'numbers')
                  }
                  
                }
                // if sending to existing contatcs
                if (option=='existing') {
                  let cc = $('.existing').val();
                  
                  let contactSplit = cc.toString().split(',');
                  let numberCount = 0;
                  $.each(contactSplit, function(index, value){
                    numberCount = numberCount + parseInt(contactArr[value])
                          // alert();
                      });

                  let availableUnits = parseFloat("{{ Auth::user()->units->sum('available_units') }}")
                  let requiredUnits = parseFloat(numberCount) * parseFloat(pcount);
                  let capacity = availableUnits/parseFloat(pcount);
                  if (requiredUnits > availableUnits) {

                    swal({
                              title: 'Insufficient Units?',
                              text: "You only have "+availableUnits+" units but your message requires at least "+requiredUnits+" units to deliver to all numbers. If you want to continue, click proceed and we shall send your message to first "+Math.trunc(capacity)+" numbers only",
                              icon: 'warning',
                              buttons: true,
                              // confirmButtonClass: 'btn btn-success',
                              // cancelButtonClass: 'btn btn-danger',
                              // confirmButtonText: 'Yes, delete it!',

                          }).then((proceed)=>{
                            if (proceed) {
                        sendMessage(msgSlug, cc, 'contacts');
                      }

                      $this.html(oldHtml);
                    })
                  }else{
                    // return;
                    sendMessage(msgSlug, cc, 'contacts');
                  }
                
                }
              
              }
            });



            // When the send later button is clicked
            $('#send-later').on('click', function(){

              var option = $('#send-option').val();
              let msgContent = $('#message-content').val();
              let msgTitle = $('#title').val();
              
              if(msgTitle==''){
                validate('#title');
                return;
              }
              if(msgContent==''){
                validate('#message-content');
                return;
              }
              if (option==null) {
                validate('#send-option');
                return;
                
              }
              let target = $('.'+option);
              if (target.val()=='') {
                validate('.'+option);
                return
              }else{

                let msgSlug = $('#message-slug').val();
                $('#calendar-modal').modal('show');	
              }
              
            })

            $('#save-schedule').on('click', function(){
              saveSchedule();
            })



            $('.custom-select2').next().find('.select2-selection__rendered').click(function(){
              // alert('hey');
            });

            function saveSchedule(option){
              let date = $('.-selected-').attr('data-date');
              let month = parseInt($('.-selected-').attr('data-month'))+1;
              let year = $('.-selected-').attr('data-year');
              let hour = $('.datepicker--time-current-hours').text()
              let minute = $('.datepicker--time-current-minutes').text()
              let ampm = $('.datepicker--time-current-ampm').text()
              let fulldate = date+'-'+month+'-'+year+' '+hour+':'+minute+' '+ampm;

              let recipientption = $('#send-option').val();
              
              if (recipientption=='existing') {
                let msgSlug = $('#message-slug').val();
                let Receivingcontacts = $('.existing').val()
                $.ajax({
                  type: 'POST',
                  url: "{{ route('shedule-message') }}",
                  data: {
                    slug: msgSlug,
                    contacts: Receivingcontacts,
                    fulldate: fulldate,
                    @isset($action)
                    @if($action=='modify_schedule')
                    action: "{{ $action }}",
                    msgId: "{{ $message->id }}",
                    @endif
                    @endisset
                    _token: universal_token
                  },
                  success:function(response){
                    let feedback = JSON.parse(response);
                    if (feedback.status=='success') {
                      window.location.replace("{{ route('scheduled-sms') }}");
                    }
                    
                  }
                });
              }
              if (recipientption=='manual_input') {
                let msgSlug = $('#message-slug').val();
                let Receivingcontacts = $('.existing').val();
                let ReceivingNumbers = $('#contact-input').val();
                
                $.ajax({

                  type: 'POST',
                  url: "{{ route('shedule-message') }}",
                  data: {
                    slug: msgSlug,
                    numbers: ReceivingNumbers,
                    fulldate: fulldate,
                    @isset($action)
                    @if($action=='modify_schedule')
                    action: "{{ $action }}",
                    msgId: "{{ $message->id }}",
                    @endif
                    @endisset
                    _token: universal_token
                  },
                  success:function(response){
                    let feedback = JSON.parse(response);
                    if (feedback.status=='success') {
                      window.location.replace("{{ route('scheduled-sms') }}");
                    }
                    
                  }
                });
              }
              
            }

            function validate(element){
              
              if($(element).hasClass('custom-select2')){
                $(element).next().css('border', '1px solid red');
                $(element).next().next().show();
              }else{

                if($(element).attr('data-role')=='tagsinput') {
                  $(element).prev().css('border', '1px solid red');
                  $(element).next().show();
                }else{
                  $(element).css('border', '1px solid red');
                  $(element).next().show();
                }
                
              }

              // scroll to section using element as target
              $('html, body').animate({
                  scrollTop: $(element).offset().top - 100
              }, 1000);
              
            }

            function unvalidate(element){
              if($(element).hasClass('custom-select2')){
                $(element).next().css('border', '1px solid #d4d4d4');
                $(element).next().next().hide();
              }else{
                if ($(element).attr('data-role')=='tagsinput') {
                  $(element).prev().css('border', '1px solid #d4d4d4');
                  $(element).next().hide();
                }else{
                  $(element).css('border', '1px solid #d4d4d4');
                  $(element).next().hide();
                }
                
              }
              
            }

            function sendMessage(msgSlug, data, contactTypes){

              // alert(contactTypes);return;
              const setData = async (contactTypes)=>{
                
                if(contactTypes=='numbers'){
                  
                  return  {
                    slug: msgSlug,
                    numbers: data,
                    _token: universal_token
                  }
                }

                if(contactTypes=='contacts'){
                  // alert(contactTypes);
                  return  {
                    slug: msgSlug,
                    contacts: data,
                    _token: universal_token
                  }
                }
              
                
              }
              
              
              setData(contactTypes).then(payLoad => deliverMessage(payLoad));

              function deliverMessage(payLoad){
                
                $.ajax({
                  type: 'POST',
                  url: "{{ route('send-composed-message') }}",
                  data: payLoad,
                  success:function(response){

                    let feedback = JSON.parse(response);

                    if (feedback.status == 'success') {

                      window.location.replace("{{ route('sent-sms') }}");

                    }else{

                      $this.html(oldHtml);

                      swal({
                        title: feedback.status,
                        text: feedback.msg,
                        icon: feedback.alert,
                      })

                      $this.html(oldHtml)

                      return;
                    }
                  },
                  error:function(par1, par2, par3){

                    alert(par3)

                    $this.html(oldHtml)
                  }
                });
                
              }
              
            }

            $('#message-content').on('keydown', function(e){

              var titleVal = $('#title').val();
              if (titleVal.length==0) {
                alert('enter message title first')
                $('#title').css('border-color', '#dd4c4c')
                return false;
              }else{

                $('#message-content').on('input', function(e){
                  $('#title').css('border-color', '#d4d4d4')
                  countChar();
                })
              }
              
            })
            var pcount = 1;
            // countChar();

            function countChar(){
              let charCount = $('#message-content').val().length;

              let countFactor = parseFloat(charCount/150)
              let countFactorStr = countFactor.toString();
              let countSplit = countFactorStr.split('.')
              
              let wholeNo = countSplit[0];
              let fraction = countSplit[1];

              let fractionToNo = parseInt(fraction)
              console.log(fractionToNo);
              if (isNaN(fractionToNo)) {
                addFactor = 0
              }else{
                addFactor = 1
              }

              let pageCount = parseInt(wholeNo) + parseInt(addFactor);

              pcount= pageCount;
              
              // alert(wholeNo)
              $('#char-count').html(charCount)
              $('#page-count').html(pageCount)
            }
            countChar()

          })
          

        </script>
@endsection