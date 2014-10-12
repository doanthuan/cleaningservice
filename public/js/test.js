oldRecords = [{id:1, type:1, data:"AAA"}, {id:2, type:2, data:"BBB"}]
newRecords = [{id:3, type:1, data:"CCC"}, {id:2, type:3, data: "DDD"}]

//1
function mergeArray(oldRecords, newRecords) {
    var records = [];
    for (var i = 0; i < newRecords.length; i++) {
        var newRecord = newRecords[i];
        if (typeof oldRecords[i] != 'undefined') {
            if(newRecord.type != oldRecords[i].type){
                records.push(newRecord);
            }
        }
        else{
            records.push(newRecord);
        }
    }
    return records;
}

function mergeEqualArray(oldRecords, newRecords)
{
    var records = [];

    var minlength = oldRecords.length > newRecords.length ? newRecords.length: oldRecords.length;

    for (var i = 0; i < minlength; i++) {
        var newRecord = newRecords[i];
        if (newRecord.type == oldRecords[i].type && newRecord.data != oldRecords[i].data) {
            records.push(newRecord);
        }
    }
    return records;
}

//
var result1 = mergeArray(oldRecords, newRecords);
var result2 = mergeArray(newRecords, oldRecords);
var result3 = mergeEqualArray(oldRecords, newRecords);

console.log(result1);
console.log(result2);
console.log(result3);