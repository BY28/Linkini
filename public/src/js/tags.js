[].forEach.call(document.getElementsByClassName('tags-input'), function (el) {
    let hiddenInput = document.createElement('input'),
        mainInput = document.createElement('input'),
        tags = [];
    
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('id', 'hidden-tags-input');
    hiddenInput.setAttribute('name', el.getAttribute('data-name'));

    mainInput.setAttribute('type', 'text');
    mainInput.classList.add('main-input');
    mainInput.setAttribute('placeholder', 'Mot clé(ex:plomberie...)');
    mainInput.addEventListener('input', function () {
        let enteredTags = mainInput.value.split(' ');

        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
        if(tags.length >= 5)
        {
            mainInput.setAttribute('placeholder', ' ');
        }
    });
    mainInput.addEventListener('keydown', function (e) {
        let keyCode = e.which || e.keyCode;
        if (keyCode === 8 && mainInput.value.length === 0 && tags.length > 0) {
            removeTag(tags.length - 1);
        }
        else if(keyCode === 13 && mainInput.value.length != 0){
            if(mainInput.value != '')
            {    
                addTag(mainInput.value);
                mainInput.value = '';
            }
        }
    });

    $('#post_search').on('submit',function(){
        if(mainInput.value != '')
        {  
            addTag(mainInput.value);
            mainInput.value = '';
        }
    });

    $('#project_create_form').on('submit',function(){
        if(mainInput.value != '')
        {  
            addTag(mainInput.value);
            mainInput.value = '';
        }
    });

    $('#project_update_form').on('submit',function(){
        if(mainInput.value.indexOf(' ') < 0 && mainInput.value != '')
        {
            addTag(mainInput.value);
        }
        let enteredTags = mainInput.value.split(' ');

        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
        if(tags.length >= 5)
        {
            mainInput.setAttribute('placeholder', ' ');
        }
       /* if(mainInput.value != '')
        {  
            addTag(mainInput.value);
            mainInput.value = '';
        }*/
        mainInput.value = '';
    });
$('#projectEditModal').on('hidden.bs.modal', function (e) {
    console.log('Modal Hides!');
    tags = [];
    enteredTags = [];
    $('#hidden-tags-input').val(null);
    $('#hidden-tags-input').removeAttr('value');
    $('.main-input').val(null);
    $('.tag').remove();
});

$('#projectEditModal').on('show.bs.modal', function (event) {
    
    let enteredTags = mainInput.value.split(' ');

        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
        if(tags.length >= 5)
        {
            mainInput.setAttribute('placeholder', ' ');
        }
 mainInput.value = '';

});
    mainInput.addEventListener("focus", function() {
        let enteredTags = mainInput.value.split(' ');

        if (enteredTags.length > 1) {
            enteredTags.forEach(function (t) {
                let filteredTag = filterTag(t);
                if (filteredTag.length > 0)
                    addTag(filteredTag);
            });
            mainInput.value = '';
        }
        if(tags.length >= 5)
        {
            mainInput.setAttribute('placeholder', ' ');
        }
 mainInput.value = '';
    }, true);

    el.appendChild(mainInput);
    el.appendChild(hiddenInput);


    function addTag (text) {
        if(tags.length < 5)
        {
        let tag = {
            text: text,
            element: document.createElement('span'),
        };

        tag.element.classList.add('tag');
        tag.element.textContent = tag.text;

        let closeBtn = document.createElement('span');
        closeBtn.classList.add('close');
        closeBtn.addEventListener('click', function () {
            removeTag(tags.indexOf(tag));
        });
        tag.element.appendChild(closeBtn);

        tags.push(tag);

        el.insertBefore(tag.element, mainInput);

        refreshTags();
        }
        else
        {
            alert('Veuillez entrer un maximum de 5 tags');
        }
    }

    function removeTag (index) {
        let tag = tags[index];
        tags.splice(index, 1);
        el.removeChild(tag.element);
        refreshTags();
    }

    function refreshTags () {
        let tagsList = [];
        tags.forEach(function (t) {
            tagsList.push(t.text);
        });
        hiddenInput.value = tagsList.join('+');
    }

    function filterTag (tag) {
        return tag.replace(/[^\w -]/g, '').trim().replace(/\W+/g, '-');
    }
});