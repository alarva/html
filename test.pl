#!/usr/bin/perl
use Text::Iconv;
my $converter = Text::Iconv -> new ("utf-8", "windows-1251");

# Text::Iconv is not really required.
# This can be any object with the convert method. Or nothing.

use Spreadsheet::XLSX;
use strict;
use warnings;
use Excel::Writer::XLSX;

my $excel = Spreadsheet::XLSX -> new ('gover.xlsx', $converter);
my $workbook  = Excel::Writer::XLSX->new( 'hoja.xlsx' );
my $worksheet = $workbook->add_worksheet();
my $index="";
foreach my $sheet (@{$excel -> {Worksheet}}) {
  my $namesheet=$sheet->{Name};
  if($namesheet eq "L-DEP-SRV")
  {
    printf("Sheet: %s\n", $sheet->{Name});

    $sheet -> {MaxRow} ||= $sheet -> {MinRow};

    foreach my $row ($sheet -> {MinRow} .. $sheet -> {MaxRow}) {

           $sheet -> {MaxCol} ||= $sheet -> {MinCol};

           foreach my $col ($sheet -> {MinCol} ..  $sheet -> {MaxCol}) {

                   my $cell = $sheet -> {Cells} [$row] [$col];
		   my $indexRow=$row+1;
                   if ($cell) {
                      if($col == 0)
                      {
                        $index="A".$indexRow;
                      }
                      if($col == 1)
                      {
                        $index="B".$indexRow;
                      }
                      if($col == 2)
                      {
                        $index="C".$indexRow;
                      }
                      if($col == 3)
                      {
                        $index="D".$indexRow;
                      }
                        $worksheet->write( $index, $cell -> {Val} );                    
                        printf("( %s , %s , %s ) => %s\n", $row, $col, $index, $cell -> {Val});
                   }

           }

    }
    $workbook->close;
  }

  }

