/*
	
	Blog Entry:
	Ask Ben: Print Part Of A Web Page With jQuery
	
	Code Snippet:
	2
	
	Author:
	Ben Nadel / Kinky Solutions
	
	Link:
	http://www.bennadel.com/index.cfm?event=blog.view&id=1591
	
	Date Posted:
	May 21, 2009 at 9:10 PM
	
*/

/**
 * Edited by: Morris Jencen O. Chavez <macinville@gmail.com>
 */
(function($) {
    var mac;

    // Create a jquery plugin that prints the given element.
    jQuery.fn.print = function(options){
        mac = $.extend({}, $.fn.print.defaults, options);
        // NOTE: We are trimming the jQuery collection down to the
        // first element in the collection.
        if (this.size() > 1){
            this.eq( 0 ).print();
            return;
        } else if (!this.size()){
            return;
        }
 
        // ASSERT: At this point, we know that the current jQuery
        // collection (as defined by THIS), contains only one
        // printable element.
 
        // Create a random name for the print frame.
        var strFrameName = ("printer-" + (new Date()).getTime());
 
        // Create an iFrame with the new name.
        var jFrame = $( "<iframe name='" + strFrameName + "'>" );
 
        // Hide the frame (sort of) and attach to the body.
        if(!mac.debug)   {
            jFrame
            .css( "width", "0px" )
            .css( "height", "0px" )
            .css( "position", "absolute" )
            .css( "left", "-9999px" )
            .css( "top", "-9999px" );
        }
        else    {
            jFrame
            .css( "width", mac.dbgWidth )
            .css( "height", mac.dbgHeight )
            .css( "position", "absolute" )
        }

        jFrame.appendTo( $( "body:first" ) );
 
        // Get a FRAMES reference to the new frame.
        var objFrame = window.frames[ strFrameName ];
 
        // Get a reference to the DOM in the new frame.
        var objDoc = objFrame.document;
 
        // Grab all the style tags and copy to the new
        // document so that we capture look and feel of
        // the current document.
 
        // Create a temp document DIV to hold the style tags.
        // This is the only way I could find to get the style
        // tags into IE.
        var jStyleDiv = $( "<div>" ).append(
            $( "style" ).clone()
            );

    /**
     * Write the contents in a variable first then print them all at once
     * As described by Jaxley @http://www.bennadel.com/blog/1591-Ask-Ben-Print-Part-Of-A-Web-Page-With-jQuery.htm
     * @quote "FYI, you have some bugs in your HTML markup. You can't put the head tag within the body tag.
     * Also, writing is fairly slow in general so you could optimize your html
     * by creating a string first and writing once instead of multiple writes."
     *
     * I think it is also great to use html4 instead of xhtml for older browsers. What do you think?
     */    
        var printContents = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">" +
            "<html>" +
            "<head><title>" + mac.documentName + "</title>" +
            jStyleDiv.html() +
            '<link rel="stylesheet" type="text/css" href="'+mac.cssFile+'" />' +
            "</head>" +
            "<body>" +
            this.html() +
            "</body></html>";

        // Write the HTML for the document. In this, we will
        // write out the HTML of the current element.
        objDoc.open();
        objDoc.write(printContents);
        objDoc.close(); 
    
   
        // Print the document.
        objFrame.focus();

        /**
     * Added on March 18, 2011
     *
     * I've been scrolling down and reading the comments now regarding the script,
     * and this is one of the improvements Douglas has pointed out so as to address
     * the issue when printing flash content in IE 7/8,wherein they are being scaled down.
     */
        try {
            var exec = objDoc.execCommand('print',false,null);
        }
        catch(err)    {
        //catch nothing
        }
        if(exec!=true && !mac.debug)    {
            objFrame.print();
        }
 
        // Have the frame remove itself in about a minute so that
        // we don't build up too many of these frames.
        if(!mac.debug) {
            setTimeout(
                function(){
                    jFrame.remove();
                },
                (mac.timeOut * 1000)
                );
        }
        $.fn.print.defaults = {
            debug: false,
            dbgHeight: '100%',
            dbgWidtht: '100%',
            cssFile: '',
            documentName : document.title,
            timeOut: 60
        };
    }
})(jQuery);