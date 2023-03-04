let sha1 = require("js-sha1");
export default {
    data() {
        return {
            records: {
                cv:[],
              },
              toStore: {
                cv:[],
              },
              recordsForUpload: {
                cv:[],
              },
              loading: {
                cv:false,
              },
              uploadHeaders: {},
        }
    },
    created: function() {
       console.log('c est moi !!!!!!!!!!!!!!!!!')
      },
    methods: {

        retourError(res, type) {
            this.loading[type] = false;
            console.log(this.recordsForUpload[type]);
        },
        retourUpload(res, type) {
            this.toStore[type] = this.toStore[type].concat(res);
            this.recordsForUpload[type] = [];
            this.loading[type] = false;
            console.log(this.toStore[type]);
        },
        async uploadFiles(type, format, folder) {
            const CLOUDINARY_UPLOAD_PRESET = "ml_default";
            this.loading[type] = true;
            console.log(this.recordsForUpload[type]);
            await this.$refs[type].upload(
                "https://api.cloudinary.com/v1_1/" + this.cloudName + "/" + format + "/upload",
                this.uploadHeaders,
                this.recordsForUpload[type],
                (fileRecord) => {
                    let formData = new FormData();
                    formData.append("upload_preset", "ml_default");
                    formData.append("folder", folder);
                    formData.append("file", fileRecord.file);
                    return formData;
                }
            );
        },
        async formDataDeleted(public_id) {
            const timestamp = new Date().getTime();
            const api_key = "721474231639524";
            const string1 =
                "public_id=" +
                public_id +
                "&timestamp=" +
                timestamp +
                "tKW-g80_eRQbtSHSjwQHbfNzwDc";
            const signature = await sha1(string1);
            let formData = new FormData();
            formData.append("public_id", public_id);
            formData.append("signature", signature);
            formData.append("timestamp", timestamp);
            formData.append("api_key", api_key);
            return formData;
        },
        async deleteUploadedFile(fileRecord, type, format) {
            let ele1 = this.toStore[type].find((row) => {
                console.log(row.fileRecord);
                if (row.fileRecord == fileRecord) {
                    return row;
                }
            });
            console.log("ele1");
            console.log(ele1);
            if (ele1 != null) {
                var k = this.toStore[type].indexOf(ele1);
                if (k !== -1) this.toStore[type].splice(k, 1);
                const public_id = ele1.data.public_id;
                const donnee= await this.formDataDeleted(public_id);
                console.log("donnee")
                console.log(donnee)
                    axios.post(
                        "https://api.cloudinary.com/v1_1/" + this.cloudName + "/" + format + "/destroy",
                       donnee,
                    )
                    .then((res) => {
                        console.log("nathe");
                        console.log(res.data);
                    }) .catch(({ response: { data } }) => {
                        console.log(data.message);
                      });
            }
    
            //const
        },
        filesSelected(fileRecordsNewlySelected, type) {
            console.log("selected");
            console.log(fileRecordsNewlySelected);
            var validFileRecords = fileRecordsNewlySelected.filter(
                (fileRecord) => !fileRecord.error
            );
            this.recordsForUpload[type] = this.recordsForUpload[type].concat(
                validFileRecords
            );
        },
        onBeforeDelete(fileRecord, type) {
            var i = this.recordsForUpload[type].indexOf(fileRecord);
            if (i !== -1) {
                // queued file, not yet uploaded. Just remove from the arrays
                this.recordsForUpload[type].splice(i, 1);
                var k = this.records[type].indexOf(fileRecord);
                if (k !== -1) this.records[type].splice(k, 1);
            } else {
                if (confirm("Voulez-vous supprimer celà ?")) {
                    this.$refs[type].deleteFileRecord(fileRecord, type); // will trigger 'delete' event
                }
            }
        },
        fileDeleted(fileRecord, type,format) {
            var i = this.recordsForUpload[type].indexOf(fileRecord);
            if (i !== -1) {
                this.recordsForUpload[type].splice(i, 1);
            } else {
                this.deleteUploadedFile(fileRecord, type,format);
            }
        },
    
    },
    
}
