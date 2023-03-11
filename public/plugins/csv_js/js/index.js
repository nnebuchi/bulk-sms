/* 
 * Copyright (C) 2019 Luke Melaia
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/* Semi constant values */
var SM_SCREEN_SIZE = 768;

var TABLE_COLORS = [
    // "#628c23",
    // "#266f8c",
    "#a8b6bf",
    // "#375c8c",
    // "#1d2840"
];

/**
 * Basic controls toggle button callback.
 */
$("#basic-controls-toggle").click(function() {
    if(isSM())
        toggleBasic();
});

/**
 * Hides the basic controls.
 */
function hideBasic(){
    $("#basic-controls").hide();
    $("#basic-controls-display").html("arrow_drop_up");
}

/**
 * Shows the basic controls.
 */
function showBasic(){
    $("#basic-controls").show();
    $("#basic-controls-display").html("arrow_drop_down");
}

/**
 * Toggles the basic controls visibility.
 */
function toggleBasic(){
    if ($("#basic-controls").is(":visible")){
        hideBasic();
    } else {
        showBasic();
    }
}

/**
 * Advanced controls toggle button callback.
 */
$("#advanced-controls-toggle").click(function() {
    if(isSM())
        toggleAdvanced();
});

/**
 * Hides the advanced controls.
 */
function hideAdvanced(){
    $("#advanced-controls").hide();
    $("#advanced-controls-display").html("arrow_drop_up");
}

/**
 * Shows the advanced controls.
 */
function showAdvanced(){
    $("#advanced-controls").show();
    $("#advanced-controls-display").html("arrow_drop_down");
}

/**
 * Toggles the advanced controls visibility.
 */
function toggleAdvanced(){
    if ($("#advanced-controls").is(":visible")){
        hideAdvanced();
    } else {
        showAdvanced();
    }
}

/**
 * 
 * @returns {Boolean} true if the browser window
 * is smaller than bootsraps col-sm trigger size.
 */
function isSM(){
    return $(window).width() < SM_SCREEN_SIZE;
}

/* Form input */

/**
 * @returns {getUserInput.userInput} an object
 * containing all the user input at the time 
 * of the method call.
 */
function getUserInput() {
    var userInput = {};
    
    userInput.maxRows = getMaxRows();
    userInput.encoding = getEncoding();
    userInput.columnSeparator = getColumnSeparator();
    userInput.useQuotes = useQuotes();
    userInput.firstRowHeaders = firstRowHeaders();
    userInput.firstRowInlcude = firstRowInclude();
    userInput.files = getFiles();
  
    function getMaxRows(){
        return $("#max-rows").val() === "" ? "0" : $("#max-rows").val();
    }

    function getEncoding(){
        return $("#encoding").val();
    }

    function getColumnSeparator(){
        return ',';
        // return $("#column-separator").val();
    }

    function useQuotes(){
        // return $("#quotes").is(":checked");
        return false;
    }
    
    function firstRowHeaders(){
        // return $("#first-row-header").is(":checked");
        return true;
    }
    
    function firstRowInclude(){
        //return $("#first-row-include").is(":checked");
        return false;
    }
    
    function getFiles(){
        return $("#upload").prop('files');
    }
    
    return userInput;
}

/* Tables */

/**
 * Randomly selects the background color of each table title
 * (.table-title) from a predefined list of colors.
 * 
 * @returns {undefined}
 */
function colorTables(){
    $(".table-title").each(function() {
        $(this).css("background-color", randomColor());
    });
    
    function randomColor(){
        return TABLE_COLORS[Math.floor(Math.random() * TABLE_COLORS.length)];
    }
}

/* Table Generation */

var tableCount = 1;

/**
 * Creates a table holder with the 
 * given table in it.
 * 
 * @param {type} title
 * @param {type} tableHtml
 * @returns {String|getTableUnit.tableHolder}
 */
function getTableUnit(title, tableHtml){
    // var id = "table-" + tableCount;
    // var downloadButton = "<button title=\"Download the editable table.\" onClick=\"downloadTable(" + tableCount + ")\" class=\"btn btn-sm btn-default\">Download <i class=\"fa fa-download\" id=\"advanced-controls-display\"></i></button>";
    // var tableHolder = "<div class=\"table-holder\" id=\"" + id + "\"><p class=\"table-title\"><b contenteditable>{@name}</b> " + downloadButton + " </p>{@table}</div>";
    // tableHolder = tableHolder.replace("{@name}", title);
    // tableHolder = tableHolder.replace("{@table}", tableHtml);
    // tableCount++;
    const tableHolder = document.querSelector('.table-holder')
    return tableHolder;
}

/**
 * Clears all tables from the page.
 */
function clearTables(){
    tableCount = 1;
    $("#tables").html("");
}

/**
 * Adds (appends) a table holder to the page.
 * 
 * @param {type} unit
 * @returns {undefined}
 */
function addTableUnit(unit){
    $("#tables").append(unit);
}

/* Table downloading */

/**
 * Download the specified table to 
 * the users computer.
 * 
 * @param {type} table table number
 * @returns {undefined}
 */
function prepareDownload(table){
    var tableId = "table-" + table;
    console.log(tableId)
    
    var myTableArray = [];

    $("#" + tableId + " > tbody tr").each(function() {
        var arrayOfThisRow = [];
        var tableData = $(this).find('th');
        if (tableData.length > 0) {
            tableData.each(function() { arrayOfThisRow.push($(this).text()); });
            myTableArray.push(arrayOfThisRow);
        }
    });

    $("#" + tableId + " > tbody tr").each(function() {
        var arrayOfThisRow = [];
        var tableData = $(this).find('td');
        if (tableData.length > 0) {
            tableData.each(function() { arrayOfThisRow.push($(this).text()); });
            myTableArray.push(arrayOfThisRow);
        }
    });
    
    var csvArray = [];
    var ta = myTableArray;
    
    var separator = getUserInput().columnSeparator;
   
    for(var i = 0; i < ta.length; i++){
        for(var j = 0; j < ta[i].length; j++){
            if(ta[i][j].includes(getUserInput().columnSeparator)){
                if(j === ta[i].length - 1)
                    csvArray.push("\"" + ta[i][j] + "\"");
                else
                    csvArray.push("\"" + ta[i][j] + "\"" + separator);
            } else {
                if(j === ta[i].length - 1)
                    csvArray.push(ta[i][j]);
                else
                    csvArray.push(ta[i][j] + separator);
            }
        }
        csvArray.push("\n");
    }
    
    var csvString = csvArray.join("");
    
    // var fileName = $("#" + tableId + " > p > b").html();
    var fileName = contact.title
    if(fileName === "" || fileName === " "){
        fileName = "Project CSV Edited File.csv";
    }
    
    if(!fileName.endsWith(".csv")){
        fileName = fileName + ".csv";
    }

    return [fileName, csvString];
}

function downloadTable(table){
    const params = prepareDownload(table);
    download(params[0], params[1]);
}

function saveFile(table){
    const params = prepareDownload(table);
    
    $.ajax({
        type:"POST",
        url:url+'/contacts/update-file',
        data:{
            filename: file_name,
            content: params[1],
            _token: universal_token
        },
        success: function(response){
            if(response?.status === 'success'){
                showAlert('success', 'Contact Saved');
            }else{
                console.log(response);
                alert('something went wrong');
            }
        },

        error: function(par1, par2, err){
            alert(err);
        }
    });
}




/**
 * Creates and downloads a file to the users computer.
 * 
 * 
 * @param {type} filename
 * @param {type} text
 * @returns {undefined}
 */
function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}

/**
 * Gets the users input and creates
 * a set of tables from it.
 */
function populate(fileContent, contact_title){
   
    var ui = getUserInput();
    addTableUnit(
        getTable(
            csvTo2DArray(
                fileContent,
                ui.columnSeparator,
                ui.useQuotes,
                ui.maxRows
            ),
        ui.firstRowHeaders, 
        ui.firstRowInlcude,
        'table-1'
        ),
            // getTableUnit(
            //     contact_title,
            //     getTable(
            //         csvTo2DArray(
            //             fileContent,
            //             ui.columnSeparator,
            //             ui.useQuotes,
            //             ui.maxRows
            //         ),
            //     ui.firstRowHeaders, 
            //     ui.firstRowInlcude
            //     ),
            // )
        );
    colorTables();
}


/**
 * Prevents users submitting the form
 * with the enter key.
 * 
 * @param {type} event description
 */
$(document).on("keypress", "form", function(event) { 
    return event.keyCode !== 13;
});

/**
 * Prevents the controls from being
 * stuck in collapsed mode.
 */
$(window).resize(function() {
    if($(window).width() < SM_SCREEN_SIZE) {
        showBasic();
        showAdvanced();
    }
});
