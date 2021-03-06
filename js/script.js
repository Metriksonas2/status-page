Vue.component("modal", {
    template: "#modal-template"
});

var app = new Vue({
    el: "#app",
    data: {
        showModal: false,

        editMode: false,
        groupsEditMode: {},
        groupsCount: 0,
        firstGroupId: 0
    },
    methods:{
        getId: function (e) { 
            console.log(e.target.getAttribute("name"));
            console.log(document.querySelectorAll('#app .card').length);
        },
        fillGroupsEditMode: function (e) { 
            var groupName = parseInt(e.target.getAttribute("name"));
            
            for (let i = this.firstGroupId; i < this.firstGroupId + this.groupsCount; i++) { 
                if (i === groupName) {
                    Vue.set(this.groupsEditMode, "group_" + i, !this.groupsEditMode["group_" + i]);
                }
                else { 
                    Vue.set(this.groupsEditMode, "group_" + i, false);
                }
            }
        }
    },
    created: function () { 
        this.groupsCount = document.querySelectorAll('#app .card').length;
        
        this.firstGroupId = parseInt(document.getElementById("group").getAttribute("name"));

        for (let i = this.firstGroupId; i < this.firstGroupId + this.groupsCount; i++) { 
            // this.groupsEditMode["group_" + i] = true;
            Vue.set(this.groupsEditMode, "group_" + i, false);
        }
    }
});