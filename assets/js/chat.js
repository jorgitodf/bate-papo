var chat = {

    groups: [],
    groupsList: [],

    setGroup:function(id, name) {
        var found = false;
        for(var i in this.groups) {
            if (this.groups[i] == id) {
                found = true;        
            }
        }

        if (found == false) {
            this.groups.push({
                id:id,
                name:name
            });
        }
        this.updateGroups();
    },
    
    getGroups:function() {
        return this.groups;
    },

    updateGroups:function() {
        var html = "";

        for(var i in this.groups) {
            html += '<li>' + this.groups[i].name + '</li>';
        }
        $('nav ul').html(html);
    },

    loadGroupList:function(id) {
        $.ajax({
            url:BASE_URL + 'ajax/getGroups',
            type:'GET',
            dataType:'json',
            success:function(json) {
                if (json.status == '1') {
                    this.groupsList = json.groups;
                    var html = '';
                    for(var i in this.groupsList) {
                        html += '<button data-id="' + this.groupsList[i].id + '">' + this.groupsList[i].name + '</button>';    
                    }
                    $('#'+id).html(html);
                } else {
                    window.location.href = BASE_URL+'login';
                }
            }
        });
    }

};