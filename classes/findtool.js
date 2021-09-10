$(function()
    {
    //set up the click handler of the search button.
    $("#searchTool").click(function()
                                {
                                searchTooltoDatabase();
                                }
                        );

                        searchTooltoDatabase();
    } //end document ready function
);

/*
 *Function to handle search button.
 */
function searchTooltoDatabase()
{
var tubular=$("#tubular").val();    //get value of keyword text field
populateTable(tubular);             //populate table
} //end function

/*
Function to populate table using Ajax.
 */
function populateTable(keyword)
{
var url="index.php";              //request URL
var data={"keyword":tubular};   

//send Ajax request
$.getJSON(  url,
            data,
            function(result)
            {
                $("#tooltable").empty();   //remove all children first
                for (var index in result)       //iterate through the reply (in JSON)
                {
                    var tubular=result[index];                     
                    var htmlCode="<tr>";                        //compose HTML of a row
                    htmlCode+="<td>"+tubular["OD"]+"</td>";   //compose cells
                    htmlCode+="<td>"+tubular["ID"]+"</td>";
                    htmlCode+="<td>"+tubular["Weight"]+"</td>";
                                        htmlCode+="</tr>";
                    $("#tooltable").append(htmlCode);      
                }
            } //end callback function
        ); //end function call
} //end function