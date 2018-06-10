var chat = {

    groups: [],

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
    }

};