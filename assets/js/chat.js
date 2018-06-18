var chat = {

    groups: [],
    activeGroup: 0,

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
                name:name,
                messages:[{
                    id:1, sender_id:1, sender_name:'Jorgito', sender_date:'10:00', msg:'Oi, tudo bem?'
                }]
            });
        }
        if (this.groups.length == 1) {
            this.setActiveGroup(id);
        }
        this.updateGroups();
    },
    
    getGroups:function() {
        return this.groups;
    },

    updateGroups:function() {
        var html = "";

        for(var i in this.groups) {
            html += '<li data-id="'+ this.groups[i].id+'">' + this.groups[i].name + '</li>';
        }

        $('nav ul').html(html);
        this.loadConversation();
    },

    loadGroupList:function(ajaxCallback) {
        $.ajax({
            url:BASE_URL + 'ajax/getGroups',
            type:'GET',
            dataType:'json',
            success:function(json) {
                if (json.status == '1') {
                    ajaxCallback(json);
                } else {
                    window.location.href = BASE_URL+'login';
                }
            }
        });
    },

    addNewGroup:function(groupName, ajaxCallback) {
        $.ajax({
            url:BASE_URL + 'ajax/addGroup',
            type:'POST',
            data:{name:groupName},
            dataType:'json',
            success:function(json) {
                if (json.status == '1') {
                    ajaxCallback(json);
                } else {
                    window.location.href = BASE_URL+'login';
                }
            }
        });
    },

    setActiveGroup:function(id) {
        this.activeGroup = id;
        this.loadConversation();
    },

    getActiveGroup:function() {
        return this.activeGroup;
    },

    loadConversation:function() {
        if (this.activeGroup != 0) {
            $('nav ul').find('.active_group').removeClass('active_group');
            $('nav ul').find('li[data-id='+this.activeGroup+']').addClass('active_group');
        }

        this.showMessages();
    },

    showMessages:function() {
        $('.messagens').html('');
        if (this.activeGroup != 0) {
            var msgs = [];
            for (var i in this.groups) {
                if (this.groups[i].id == this.activeGroup) {
                    msgs = this.groups[i].messages;
                }
            }
            for (var i in msgs) {
                var html = '<div class="message">';
                html += '<div class="m_info">';
                html += '    <span class="m_sender">'+msgs[i].sender_name+'</span>';
                html += '    <span class="m_date">'+msgs[i].sender_date+'</span>';
                html += '</div>';
                html += '<div class="m_body">';
                html += msgs[i].msg;
                html += '</div>';
                html += '</div>';

                $('.messagens').append(html);
            }
        }
    }

};